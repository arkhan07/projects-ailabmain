@php
    $model = $payment_details['success_method']['model_name'];

    if ($model == 'InstructorPayment') {
        $payment_keys = DB::table('users')
            ->where('id', $payment_details['items'][0]['id'])
            ->value('paymentkeys');

        $keys = isset($payment_keys) ? json_decode($payment_keys) : null;

        $secret_key = $secret_live_key = '';
        if ($keys) {
            if ($payment_gateway->test_mode == 1) {
                $secret_key = $keys->xendit->secret_key ?? '';
            } else {
                $secret_live_key = $keys->xendit->secret_live_key ?? '';
            }
        }

        $api_key = $payment_gateway->test_mode == 1 ? $secret_key : $secret_live_key;

        if ($api_key == '') {
            $msg = get_phrase('This payment gateway is not configured.');
        }
    } else {
        $payment_keys = json_decode($payment_gateway->keys, true);
        $api_key = '';

        if ($payment_keys != '') {
            if ($payment_gateway->status == 1) {
                if ($payment_gateway->test_mode == 1) {
                    $api_key = $payment_keys['secret_key'] ?? '';
                } else {
                    $api_key = $payment_keys['secret_live_key'] ?? '';
                }
                if ($api_key == '') {
                    $msg = get_phrase('This payment gateway is not configured.');
                }
            } else {
                $msg = get_phrase('Admin denied transaction through this gateway.');
            }
        } else {
            $msg = get_phrase('This payment gateway is not configured.');
        }
    }
@endphp

<style>
    /* Xendit Payment Gateway Styles - Isolated to prevent conflicts */
    .xendit-payment-container {
        padding: 24px !important;
        background: rgba(29, 29, 29, 0.95) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 20px !important;
        overflow: hidden !important;
        margin: 0 !important;
    }

    .xendit-payment-container .xendit-payment-info {
        margin-bottom: 24px !important;
        padding: 20px !important;
        background: rgba(0, 234, 203, 0.05) !important;
        border: 1px solid rgba(0, 234, 203, 0.2) !important;
        border-radius: 12px !important;
    }

    .xendit-payment-container .xendit-payment-info h4 {
        color: rgb(0, 234, 203) !important;
        font-family: "DM Sans", sans-serif !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        margin-bottom: 12px !important;
        margin-top: 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .xendit-payment-container .xendit-payment-info p {
        color: rgba(255, 255, 255, 0.8) !important;
        font-family: "DM Sans", sans-serif !important;
        font-size: 14px !important;
        margin: 0 !important;
        line-height: 1.6 !important;
    }

    .xendit-payment-container .xendit-payment-info ul {
        margin: 12px 0 0 0 !important;
        padding-left: 20px !important;
        color: rgba(255, 255, 255, 0.7) !important;
        list-style: disc !important;
    }

    .xendit-payment-container .xendit-payment-info ul li {
        margin: 6px 0 !important;
        font-family: "DM Sans", sans-serif !important;
        font-size: 13px !important;
        line-height: 1.8 !important;
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .xendit-payment-container .xendit-pay-button {
        width: 100% !important;
        padding: 16px 24px !important;
        background: linear-gradient(90deg, rgba(0, 83, 72, 1) 0%, rgba(0, 238, 207, 1) 100%) !important;
        border: none !important;
        border-radius: 12px !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 12px !important;
        text-decoration: none !important;
        margin-bottom: 12px !important;
        box-sizing: border-box !important;
    }

    .xendit-payment-container .xendit-pay-button .btn-text {
        font-family: "DM Sans", sans-serif !important;
        font-weight: 600 !important;
        font-size: 16px !important;
        color: #ffffff !important;
    }

    .xendit-payment-container .xendit-pay-button .btn-icon {
        display: flex !important;
        align-items: center !important;
        color: #ffffff !important;
    }

    .xendit-payment-container .xendit-pay-button:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(0, 238, 207, 0.3) !important;
        text-decoration: none !important;
    }

    .xendit-payment-container .xendit-pay-button:active {
        transform: translateY(0) !important;
    }

    .xendit-payment-container .xendit-pay-button svg {
        width: 20px !important;
        height: 20px !important;
    }

    .xendit-payment-container .xendit-error-container {
        padding: 20px !important;
        background: rgba(255, 59, 48, 0.1) !important;
        border: 1px solid rgba(255, 59, 48, 0.3) !important;
        border-radius: 12px !important;
        display: flex !important;
        align-items: start !important;
        gap: 12px !important;
    }

    .xendit-payment-container .xendit-error-icon {
        flex-shrink: 0 !important;
        width: 24px !important;
        height: 24px !important;
        color: #ff3b30 !important;
    }

    .xendit-payment-container .xendit-error-content {
        flex: 1 !important;
    }

    .xendit-payment-container .xendit-error-content strong {
        color: #ff3b30 !important;
        display: block !important;
        margin-bottom: 4px !important;
        font-family: "DM Sans", sans-serif !important;
        font-size: 16px !important;
        font-weight: 700 !important;
    }

    .xendit-payment-container .xendit-error-content p {
        color: rgba(255, 255, 255, 0.8) !important;
        font-family: "DM Sans", sans-serif !important;
        margin: 0 !important;
        font-size: 14px !important;
        line-height: 1.5 !important;
    }

    .xendit-payment-container .xendit-test-mode-badge {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 6px 12px !important;
        background: rgba(255, 193, 7, 0.1) !important;
        border: 1px solid rgba(255, 193, 7, 0.3) !important;
        border-radius: 6px !important;
        font-family: "DM Sans", sans-serif !important;
        font-size: 12px !important;
        color: #ffc107 !important;
        font-weight: 600 !important;
        margin-bottom: 16px !important;
    }

    .xendit-payment-container .xendit-secure-badge {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        padding: 12px !important;
        background: rgba(255, 255, 255, 0.03) !important;
        border-radius: 8px !important;
    }

    .xendit-payment-container .xendit-secure-badge svg {
        color: rgb(0, 234, 203) !important;
        width: 16px !important;
        height: 16px !important;
    }

    .xendit-payment-container .xendit-secure-badge span {
        font-family: "DM Sans", sans-serif !important;
        font-size: 12px !important;
        color: rgba(255, 255, 255, 0.6) !important;
    }

    @media screen and (max-width: 768px) {
        .xendit-payment-container {
            padding: 20px;
            border-radius: 16px;
        }

        .xendit-payment-info h4 {
            font-size: 15px;
        }

        .xendit-payment-info p,
        .xendit-payment-info ul li {
            font-size: 13px;
        }
    }
</style>

<div class="xendit-payment-container">
    @if ($api_key != '')
        @if ($payment_gateway->test_mode == 1)
            <div class="xendit-test-mode-badge">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                {{ get_phrase('Test Mode Active') }}
            </div>
        @endif

        <div class="xendit-payment-info">
            <h4>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                {{ get_phrase('Payment Information') }}
            </h4>
            <p>{{ get_phrase('You will be redirected to Xendit secure payment page where you can complete your payment using:') }}</p>
            <ul>
                <li>{{ get_phrase('Credit/Debit Cards (Visa, Mastercard, JCB)') }}</li>
                <li>{{ get_phrase('Bank Transfers (BCA, Mandiri, BNI, BRI, Permata)') }}</li>
                <li>{{ get_phrase('E-Wallets (OVO, DANA, LinkAja, ShopeePay)') }}</li>
                <li>{{ get_phrase('Retail Outlets (Alfamart, Indomaret)') }}</li>
            </ul>
        </div>

        <a href="{{ route('payment.create', $payment_gateway->identifier) }}" class="xendit-pay-button">
            <span class="btn-text">{{ get_phrase('Continue to Xendit Payment') }}</span>
            <span class="btn-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </span>
        </a>

        <div class="xendit-secure-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <span>{{ get_phrase('Secured by Xendit - Your payment information is protected') }}</span>
        </div>
    @else
        <div class="xendit-error-container">
            <svg class="xendit-error-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <div class="xendit-error-content">
                <strong>{{ get_phrase('Payment Gateway Not Available') }}</strong>
                <p>{{ $msg }} {{ get_phrase('Please select another payment method or contact support.') }}</p>
            </div>
        </div>
    @endif
</div>
