@extends('layouts.auth')
@push('title', get_phrase('Checkout'))
@push('css')
<style>
    /* ========================================
       1001 PIONEER AI - CHECKOUT STYLES
       ======================================== */

    .checkout-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background-color: #1d1d1d;
        position: relative;
        overflow-x: hidden;
    }

    /* Background Gradients */
    .bg-gradient {
        position: fixed;
        width: 600px;
        height: 600px;
        border-radius: 50%;
        filter: blur(80px);
        pointer-events: none;
        z-index: 0;
    }

    .bg-gradient-top {
        top: -200px;
        left: -200px;
        background: radial-gradient(ellipse at center, rgba(0, 234, 203, 0.15) 0%, rgba(0, 234, 203, 0) 70%);
    }

    .bg-gradient-bottom {
        bottom: -200px;
        right: -200px;
        background: radial-gradient(ellipse at center, rgba(0, 234, 203, 0.1) 0%, rgba(0, 234, 203, 0) 70%);
    }

    /* =====================================
       HEADER
       ===================================== */
    .checkout-header {
        padding: 20px 60px;
        background: rgba(29, 29, 29, 0.8);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .checkout-logo img {
        height: 40px;
        width: auto;
        transition: transform 0.3s ease;
    }

    .checkout-logo:hover img {
        transform: scale(1.05);
    }

    .checkout-title {
        font-family: "DM Sans", sans-serif;
        font-weight: 700;
        font-size: 24px;
        color: #ffffff;
        margin: 0;
        flex: 1;
        text-align: center;
    }

    .header-spacer {
        width: 40px;
    }

    /* =====================================
       MAIN CONTENT
       ===================================== */
    .checkout-main {
        flex: 1;
        padding: 40px 60px;
        position: relative;
        z-index: 1;
    }

    .checkout-container {
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* =====================================
       CHECKOUT CARDS
       ===================================== */
    .checkout-card {
        background: rgba(29, 29, 29, 0.8);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .sticky-card {
        /* Sticky position removed for single column layout */
    }

    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-step {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgb(0, 234, 203);
        border-radius: 50%;
        font-family: "DM Sans", sans-serif;
        font-weight: 700;
        font-size: 14px;
        color: #000;
    }

    .card-title {
        font-family: "DM Sans", sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: #ffffff;
        margin: 0;
    }

    .card-body {
        padding: 24px;
    }

    /* =====================================
       PAYMENT METHODS
       ===================================== */
    .payment-methods-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .payment-method {
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px;
        background: rgba(255, 255, 255, 0.03);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .payment-method:hover {
        border-color: rgba(255, 255, 255, 0.2);
    }

    .payment-method.active {
        background: rgba(0, 234, 203, 0.05);
        border-color: rgb(0, 234, 203);
    }

    .payment-method-logo {
        width: 80px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 8px;
        padding: 8px;
    }

    .payment-method-logo img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .payment-method-info {
        flex: 1;
    }

    .payment-method-name {
        font-family: "DM Sans", sans-serif;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
    }

    /* =====================================
       ORDER ITEMS
       ===================================== */
    .order-item {
        padding: 16px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-item-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 8px;
        gap: 12px;
    }

    .order-item-number {
        font-family: "DM Sans", sans-serif;
        font-size: 12px;
        color: rgb(0, 234, 203);
        font-weight: 600;
    }

    .order-item-title {
        font-family: "DM Sans", sans-serif;
        font-size: 15px;
        color: #fff;
        font-weight: 500;
        margin: 0;
        flex: 1;
    }

    .order-item-price {
        font-family: "DM Sans", sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        white-space: nowrap;
    }

    .order-item-price del {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.4);
        margin-right: 8px;
    }

    /* =====================================
       PRICE BREAKDOWN
       ===================================== */
    .order-totals {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-row-label {
        font-family: "DM Sans", sans-serif;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.6);
    }

    .total-row-value {
        font-family: "DM Sans", sans-serif;
        font-weight: 600;
        font-size: 14px;
        color: #ffffff;
    }

    .total-row.highlight .total-row-label,
    .total-row.highlight .total-row-value {
        color: rgb(0, 234, 203);
    }

    .total-row.grand-total {
        margin-top: 6px;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .total-row.grand-total .total-row-label {
        font-weight: 600;
        font-size: 15px;
        color: #ffffff;
    }

    .total-row.grand-total .total-row-value {
        font-weight: 700;
        font-size: 22px;
        color: rgb(0, 234, 203);
    }

    /* =====================================
       CHECKOUT BUTTONS
       ===================================== */
    .checkout-actions {
        margin-top: 20px;
        display: flex;
        gap: 12px;
    }

    .btn-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 16px 24px;
        background: linear-gradient(90deg, rgba(0, 83, 72, 1) 0%, rgba(0, 238, 207, 1) 100%);
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        flex: 1;
    }

    .btn-checkout:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 238, 207, 0.3);
    }

    .btn-checkout:active:not(:disabled) {
        transform: translateY(0);
    }

    .btn-checkout:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-checkout-text {
        font-family: "DM Sans", sans-serif;
        font-weight: 600;
        font-size: 16px;
        color: #ffffff;
    }

    .btn-checkout-icon {
        display: flex;
        align-items: center;
        color: #ffffff;
    }

    .btn-checkout-secondary {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-checkout-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        box-shadow: none;
    }

    /* =====================================
       PAYMENT FORM CONTAINER
       ===================================== */
    .payment-form-container {
        display: none;
        margin-top: 20px;
    }

    .payment-form-container.active {
        display: block;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Secure Badge */
    .secure-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 8px;
        margin-top: 16px;
    }

    .secure-badge svg {
        color: rgb(0, 234, 203);
        width: 16px;
        height: 16px;
    }

    .secure-badge span {
        font-family: "DM Sans", sans-serif;
        font-size: 12px;
        color: rgba(255, 255, 255, 0.6);
    }

    /* =====================================
       RESPONSIVE - TABLET
       ===================================== */
    @media screen and (max-width: 1024px) {
        .checkout-header {
            padding: 16px 30px;
        }

        .checkout-main {
            padding: 30px;
        }

        .checkout-container {
            max-width: 600px;
        }
    }

    /* =====================================
       RESPONSIVE - MOBILE
       ===================================== */
    @media screen and (max-width: 768px) {
        .checkout-header {
            padding: 16px 20px;
        }

        .checkout-title {
            font-size: 20px;
        }

        .checkout-main {
            padding: 20px;
        }

        .checkout-card {
            border-radius: 16px;
        }

        .card-header {
            padding: 16px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .order-item-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .checkout-actions {
            flex-direction: column-reverse;
        }

        .total-row.grand-total .total-row-value {
            font-size: 20px;
        }

        .bg-gradient {
            width: 400px;
            height: 400px;
        }
    }

    @media screen and (max-width: 480px) {
        .card-title {
            font-size: 16px;
        }

        .payment-method {
            padding: 12px;
        }

        .payment-method-logo {
            width: 60px;
            height: 30px;
        }
    }
</style>
@endpush

@section('content')
<div class="checkout-wrapper">
    <div class="bg-gradient bg-gradient-top"></div>
    <div class="bg-gradient bg-gradient-bottom"></div>

    <!-- Header -->
    <header class="checkout-header">
        <a href="{{ route('home') }}" class="checkout-logo">
            <img class="logo" src="{{ get_image(get_frontend_settings('light_logo')) }}" alt="{{ get_settings('system_name') }} Logo" />
        </a>
        <h1 class="checkout-title">{{ get_phrase('Checkout') }}</h1>
        <div class="header-spacer"></div>
    </header>

    <!-- Main Content -->
    <main class="checkout-main">
        <div class="checkout-container">
            <!-- Payment Methods Card -->
            <div class="checkout-card">
                <div class="card-header">
                    <span class="card-step">1</span>
                    <h2 class="card-title">{{ get_phrase('Select Payment Method') }}</h2>
                </div>
                <div class="card-body">
                    <div class="payment-methods-list">
                        @foreach ($payment_gateways as $key => $payment_gateway)
                            <div class="payment-method {{ $key == 0 ? 'active' : '' }}"
                                 onclick="selectPaymentMethod('{{ $payment_gateway->identifier }}')"
                                 id="{{ $payment_gateway->identifier }}-tab">
                                <div class="payment-method-logo">
                                    <img src="{{ get_image('assets/payment/' . $payment_gateway->identifier . '.png') }}"
                                         alt="{{ $payment_gateway->title }}" />
                                </div>
                                <div class="payment-method-info">
                                    <p class="payment-method-name">{{ $payment_gateway->title }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary Card -->
            <div class="checkout-card">
                    <div class="card-header">
                        <span class="card-step">2</span>
                        <h2 class="card-title">{{ get_phrase('Order Summary') }}</h2>
                    </div>
                    <div class="card-body">
                        <!-- Items List -->
                        <div class="order-items">
                            @foreach ($payment_details['items'] as $key => $item)
                                <div class="order-item">
                                    <div class="order-item-header">
                                        <span class="order-item-number">#{{ $key + 1 }}</span>
                                        <p class="order-item-title">{{ $item['title'] }}</p>
                                        <div class="order-item-price">
                                            @if ($item['discount_price'] > 0)
                                                <del>{{ currency($item['price']) }}</del>
                                                {{ currency($item['discount_price']) }}
                                            @else
                                                {{ currency($item['price']) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Totals -->
                        <div class="order-totals">
                            @php
                                $payable = $payment_details['payable_amount'];
                                if (isset($payment_details['custom_field']['coupon_discount'])) {
                                    $payable = $payment_details['payable_amount'] + $payment_details['custom_field']['coupon_discount'];
                                }
                                $payable = $payable - $payment_details['tax'];
                                if (isset($payment_details['custom_field']['unique_code'])) {
                                    $payable = $payable - $payment_details['custom_field']['unique_code'];
                                }
                            @endphp

                            <div class="total-row">
                                <span class="total-row-label">{{ get_phrase('Subtotal') }}</span>
                                <span class="total-row-value">{{ currency($payable) }}</span>
                            </div>

                            @isset($payment_details['coupon'])
                                <div class="total-row highlight">
                                    <span class="total-row-label">{{ get_phrase('Coupon') }} ({{ $payment_details['coupon'] }})</span>
                                    <span class="total-row-value">- {{ currency($payment_details['custom_field']['coupon_discount']) }}</span>
                                </div>
                            @endisset

                            @if ($payment_details['tax'] > 0)
                                <div class="total-row">
                                    <span class="total-row-label">{{ get_phrase('Tax') }}</span>
                                    <span class="total-row-value">+ {{ currency($payment_details['tax']) }}</span>
                                </div>
                            @endif

                            @if (isset($payment_details['custom_field']['unique_code']))
                                <div class="total-row highlight">
                                    <span class="total-row-label">{{ get_phrase('Kode Unik') }}</span>
                                    <span class="total-row-value">+ {{ currency($payment_details['custom_field']['unique_code']) }}</span>
                                </div>
                            @endif

                            <div class="total-row grand-total">
                                <span class="total-row-label">{{ get_phrase('Grand Total') }}</span>
                                <span class="total-row-value">{{ currency($payment_details['payable_amount']) }}</span>
                            </div>
                        </div>

                        <!-- Payment Form Container -->
                        <div id="payment-form-container" class="payment-form-container">
                            <!-- Payment gateway forms will be loaded here via AJAX -->
                        </div>


                    </div>
                </div>
        </div>
    </main>
</div>

<script>
    let selectedGateway = '{{ $payment_gateways->first()->identifier ?? "" }}';

    function selectPaymentMethod(identifier) {
        // Remove active class from all methods
        document.querySelectorAll('.payment-method').forEach(method => {
            method.classList.remove('active');
        });

        // Add active class to selected method
        document.getElementById(identifier + '-tab').classList.add('active');
        selectedGateway = identifier;

        // Load payment gateway form
        showPaymentGatewayByAjax(identifier);
    }

    function showPaymentGatewayByAjax(identifier) {
        $.ajax({
            url: "{{ route('payment.show_payment_gateway_by_ajax', '') }}/" + identifier,
            type: 'GET',
            success: function(response) {
                $('#payment-form-container').html(response);
                $('#payment-form-container').addClass('active');
            },
            error: function() {
                alert('{{ get_phrase("Failed to load payment gateway") }}');
            }
        });
    }

    // Load first payment gateway on page load
    $(document).ready(function() {
        if (selectedGateway) {
            showPaymentGatewayByAjax(selectedGateway);
        }

        // Handle proceed payment button
        $('#proceed-payment-btn').click(function() {
            // Trigger the payment form submission
            $('#payment-form-container form').submit();
        });
    });
</script>
@endsection

@push('js')
@include('frontend.default.toaster')
@endpush