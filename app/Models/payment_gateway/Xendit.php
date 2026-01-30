<?php

namespace App\Models\payment_gateway;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Xendit extends Model
{
    use HasFactory;

    public static function payment_status($identifier, $transaction_keys = [])
    {
        $payment_gateway = DB::table('payment_gateways')->where('identifier', $identifier)->first();
        $keys = json_decode($payment_gateway->keys, true);

        // Get API key based on test mode
        if ($payment_gateway->test_mode == 1) {
            $api_key = $keys['secret_key'];
        } else {
            $api_key = $keys['secret_live_key'];
        }

        // Get invoice ID from multiple sources
        // 1. From URL parameter 'id' (Xendit sends this)
        // 2. From session (we store it during payment_create)
        $invoice_id = $transaction_keys['id'] ?? session('xendit_invoice_id') ?? null;

        if (!$invoice_id) {
            return false;
        }

        // Verify payment status with Xendit API
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.xendit.co/v2/invoices/' . $invoice_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode($api_key . ':'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return false;
        }

        $result = json_decode($response);

        // Check if payment status is PAID or SETTLED
        if (isset($result->status) && ($result->status == 'PAID' || $result->status == 'SETTLED')) {
            // Store transaction ID in session for payment history
            session(['xendit_transaction_id' => $invoice_id]);
            return true;
        }

        return false;
    }

    public static function payment_create($identifier)
    {
        $payment_details = session('payment_details');
        $payment_gateway = DB::table('payment_gateways')->where('identifier', $identifier)->first();
        $keys = json_decode($payment_gateway->keys, true);

        // Get API key based on test mode
        if ($payment_gateway->test_mode == 1) {
            $api_key = $keys['secret_key'];
        } else {
            $api_key = $keys['secret_live_key'];
        }

        $user = DB::table('users')->where('id', auth()->user()->id)->first();

        // Build item description
        $products_name = '';
        foreach ($payment_details['items'] as $key => $value) {
            if ($key == 0) {
                $products_name .= $value['title'];
            } else {
                $products_name .= ', ' . $value['title'];
            }
        }

        // Generate unique external ID
        $external_id = 'INV-' . time() . '-' . uniqid();

        // Prepare invoice data
        $invoice_data = [
            'external_id' => $external_id,
            'amount' => round($payment_details['payable_amount']),
            'currency' => $payment_gateway->currency,
            'description' => get_phrase('Purchasing') . ' ' . $products_name,
            'customer' => [
                'given_names' => $user->name,
                'email' => $user->email,
            ],
            'success_redirect_url' => $payment_details['success_url'] . '/' . $identifier,
            'failure_redirect_url' => $payment_details['cancel_url'],
        ];

        // Add phone number if available
        if (!empty($user->phone)) {
            $invoice_data['customer']['mobile_number'] = $user->phone;
        }

        // Create invoice via Xendit API
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.xendit.co/v2/invoices',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($invoice_data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode($api_key . ':'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return $payment_details['cancel_url'];
        }

        $result = json_decode($response);

        // Return the invoice URL for payment
        if (isset($result->invoice_url) && isset($result->id)) {
            // Store invoice ID in session for verification later
            session(['xendit_invoice_id' => $result->id]);
            return $result->invoice_url;
        }

        return $payment_details['cancel_url'];
    }
}
