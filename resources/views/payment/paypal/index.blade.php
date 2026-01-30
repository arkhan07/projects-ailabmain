@php
    $payment_keys = json_decode($payment_gateway->keys, true);

    if ($payment_gateway->test_mode == 1) {
        $client_id = $payment_keys['sandbox_client_id'];
        $paypalURL = 'https://api.sandbox.paypal.com/v1/';
    } else {
        $client_id = $payment_keys['production_client_id'];
        $paypalURL = 'https://api.paypal.com/v1/';
    }
@endphp

<style>
    /* PayPal Payment Gateway Styles - Isolated to prevent conflicts */
    .paypal-payment-container {
        padding: 24px !important;
        background: rgba(29, 29, 29, 0.95) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 20px !important;
        overflow: hidden !important;
        margin: 0 !important;
    }

    .paypal-payment-container .paypal-payment-info {
        margin-bottom: 24px !important;
        padding: 20px !important;
        background: rgba(0, 234, 203, 0.05) !important;
        border: 1px solid rgba(0, 234, 203, 0.2) !important;
        border-radius: 12px !important;
    }

    .paypal-payment-container .paypal-payment-info h4 {
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

    .paypal-payment-container .paypal-payment-info p {
        color: rgba(255, 255, 255, 0.8) !important;
        font-family: "DM Sans", sans-serif !important;
        font-size: 14px !important;
        margin: 0 !important;
        line-height: 1.6 !important;
    }

    .paypal-payment-container .paypal-payment-info ul {
        margin: 12px 0 0 0 !important;
        padding-left: 20px !important;
        color: rgba(255, 255, 255, 0.7) !important;
        list-style: disc !important;
    }

    .paypal-payment-container .paypal-payment-info ul li {
        margin: 6px 0 !important;
        font-family: "DM Sans", sans-serif !important;
        font-size: 13px !important;
        line-height: 1.8 !important;
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .paypal-payment-container .paypal-test-mode-badge {
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

    .paypal-payment-container .paypal-button-wrapper {
        background: rgba(255, 255, 255, 0.03) !important;
        padding: 20px !important;
        border-radius: 12px !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        margin-bottom: 12px !important;
    }

    .paypal-payment-container .paypal-secure-badge {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        padding: 12px !important;
        background: rgba(255, 255, 255, 0.03) !important;
        border-radius: 8px !important;
    }

    .paypal-payment-container .paypal-secure-badge svg {
        width: 16px !important;
        height: 16px !important;
        color: rgb(0, 234, 203) !important;
    }

    .paypal-payment-container .paypal-secure-badge span {
        font-family: "DM Sans", sans-serif !important;
        font-size: 12px !important;
        color: rgba(255, 255, 255, 0.6) !important;
    }

    .paypal-payment-container #paypal-button-container {
        min-height: 55px !important;
    }

    /* Loading state */
    .paypal-payment-container .paypal-loading {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        min-height: 55px !important;
        gap: 12px !important;
        color: rgba(255, 255, 255, 0.6) !important;
        font-family: "DM Sans", sans-serif !important;
    }

    .paypal-payment-container .paypal-loading-spinner {
        width: 20px !important;
        height: 20px !important;
        border: 2px solid rgba(255, 255, 255, 0.2) !important;
        border-top-color: rgb(0, 234, 203) !important;
        border-radius: 50% !important;
        animation: paypal-spin 0.8s linear infinite !important;
    }

    @keyframes paypal-spin {
        to { transform: rotate(360deg); }
    }

    @media screen and (max-width: 768px) {
        .paypal-payment-container {
            padding: 20px;
            border-radius: 16px;
        }

        .paypal-payment-info h4 {
            font-size: 15px;
        }

        .paypal-payment-info p,
        .paypal-payment-info ul li {
            font-size: 13px;
        }

        .paypal-button-wrapper {
            padding: 16px;
        }
    }
</style>

<div class="paypal-payment-container">
    @if ($payment_gateway->test_mode == 1)
        <div class="paypal-test-mode-badge">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            {{ get_phrase('Test Mode Active') }}
        </div>
    @endif

    <div class="paypal-payment-info">
        <h4>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            {{ get_phrase('Payment Information') }}
        </h4>
        <p>{{ get_phrase('Complete your payment securely with PayPal. You can use:') }}</p>
        <ul>
            <li>{{ get_phrase('PayPal Account') }}</li>
            <li>{{ get_phrase('Credit or Debit Card') }}</li>
            <li>{{ get_phrase('Venmo (US only)') }}</li>
            <li>{{ get_phrase('Pay Later options (where available)') }}</li>
        </ul>
    </div>

    <div class="paypal-button-wrapper">
        <div id="paypal-button-container">
            <div class="paypal-loading">
                <div class="paypal-loading-spinner"></div>
                <span>{{ get_phrase('Loading PayPal...') }}</span>
            </div>
        </div>
    </div>

    <div class="paypal-secure-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
        <span>{{ get_phrase('Secured by PayPal - Your payment information is protected') }}</span>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id={{ $client_id }}&enable-funding=venmo,card&currency={{ $payment_gateway->currency }}" data-sdk-integration-source="button-factory"></script>

<script>
    "use strict";

    function initPayPalButton() {
        paypal.Buttons({
            env: '<?php echo $payment_gateway->test_mode != 1 ? 'production' : 'sandbox'; ?>',
            style: {
                layout: 'vertical',
                label: 'paypal',
                size: 'large',
                shape: 'rect',
                color: 'gold',
                height: 55
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $payment_details['payable_amount']; ?>',
                            currency_code: '{{$payment_gateway->currency}}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    console.log(data);
                    // Show success message before redirect
                    const $container = $('#paypal-button-container');
                    $container.html(`
                        <div style="text-align: center; padding: 24px;">
                            <div style="width: 64px; height: 64px; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: rgba(0, 234, 203, 0.1);">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="rgb(0, 234, 203)" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                            </div>
                            <p style="font-family: 'DM Sans', sans-serif; font-size: 18px; font-weight: 700; margin: 0 0 8px 0; color: rgb(0, 234, 203);">${'<?php echo get_phrase("Payment Successful!"); ?>'}</p>
                            <p style="font-family: 'DM Sans', sans-serif; font-size: 14px; color: rgba(255,255,255,0.7); margin: 0;">${'<?php echo get_phrase("Redirecting..."); ?>'}</p>
                        </div>
                    `);

                    // Redirect after short delay
                    setTimeout(function() {
                        window.location = "{{ $payment_details['success_url'] . '/' . $payment_gateway->identifier }}" +
                            "?payment_id=" + data.orderID + "&payer_id=" + details.payer.payer_id;
                    }, 1500);
                });
            },
            onError: function(err) {
                console.error(err);
                const $container = $('#paypal-button-container');
                $container.html(`
                    <div style="text-align: center; padding: 24px;">
                        <div style="width: 64px; height: 64px; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255, 59, 48, 0.1);">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#ff3b30" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                        </div>
                        <p style="font-family: 'DM Sans', sans-serif; font-size: 18px; font-weight: 700; margin: 0 0 8px 0; color: #ff3b30;">${'<?php echo get_phrase("Payment Failed"); ?>'}</p>
                        <p style="font-family: 'DM Sans', sans-serif; font-size: 14px; color: rgba(255,255,255,0.7); margin: 0 0 20px 0;">${'<?php echo get_phrase("Please try again"); ?>'}</p>
                        <button onclick="location.reload()" style="padding: 12px 24px; background: linear-gradient(90deg, rgba(0, 83, 72, 1) 0%, rgba(0, 238, 207, 1) 100%); color: #ffffff; border: none; border-radius: 12px; font-family: 'DM Sans', sans-serif; font-weight: 600; font-size: 14px; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0, 238, 207, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            ${'<?php echo get_phrase("Try Again"); ?>'}
                        </button>
                    </div>
                `);
            }
        }).render('#paypal-button-container');
    }

    $(function() {
        const initPaypal = setInterval(function() {
            if (typeof paypal !== 'undefined') {
                initPayPalButton();
                clearInterval(initPaypal);
            }
        }, 500);
    });
</script>
