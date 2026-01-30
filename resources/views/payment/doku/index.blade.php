<link rel="shortcut icon" type="image/png"
    href="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/img/favicon.png" />

<link rel="stylesheet"
    href="https://cdn-doku.oss-ap-southeast-5.aliyuncs.com/doku-ui-framework/doku/stylesheet/css/main.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!-- Load Jokul Checkout JS script -->
<script src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>

<style>
    /* Doku Payment Gateway Styles - Isolated to prevent conflicts */
    .doku-payment-container {
        padding: 24px !important;
        background: rgba(29, 29, 29, 0.95) !important;
        backdrop-filter: blur(20px) !important;
        -webkit-backdrop-filter: blur(20px) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 20px !important;
        overflow: hidden !important;
        margin: 0 !important;
    }

    .doku-payment-container .doku-payment-info {
        margin-bottom: 24px !important;
        padding: 20px !important;
        background: rgba(0, 234, 203, 0.05) !important;
        border: 1px solid rgba(0, 234, 203, 0.2) !important;
        border-radius: 12px !important;
    }

    .doku-payment-container .doku-payment-info h4 {
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

    .doku-payment-container .doku-payment-info p {
        color: rgba(255, 255, 255, 0.8) !important;
        font-family: "DM Sans", sans-serif !important;
        font-size: 14px !important;
        margin: 0 !important;
        line-height: 1.6 !important;
    }

    .doku-payment-container .doku-payment-info ul {
        margin: 12px 0 0 0 !important;
        padding-left: 20px !important;
        color: rgba(255, 255, 255, 0.7) !important;
        list-style: disc !important;
    }

    .doku-payment-container .doku-payment-info ul li {
        margin: 6px 0 !important;
        font-family: "DM Sans", sans-serif !important;
        font-size: 13px !important;
        line-height: 1.8 !important;
        color: rgba(255, 255, 255, 0.7) !important;
    }

    .doku-payment-container .doku-pay-button {
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
        margin-bottom: 12px !important;
        box-sizing: border-box !important;
    }

    .doku-payment-container .doku-pay-button .btn-text {
        font-family: "DM Sans", sans-serif !important;
        font-weight: 600 !important;
        font-size: 16px !important;
        color: #ffffff !important;
    }

    .doku-payment-container .doku-pay-button .btn-icon {
        display: flex !important;
        align-items: center !important;
        color: #ffffff !important;
    }

    .doku-payment-container .doku-pay-button:hover:not(:disabled) {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 25px rgba(0, 238, 207, 0.3) !important;
    }

    .doku-payment-container .doku-pay-button:active:not(:disabled) {
        transform: translateY(0) !important;
    }

    .doku-payment-container .doku-pay-button:disabled {
        opacity: 0.5 !important;
        cursor: not-allowed !important;
    }

    .doku-payment-container .doku-pay-button .spinner {
        display: none !important;
        width: 20px !important;
        height: 20px !important;
        border: 2px solid #ffffff !important;
        border-top-color: transparent !important;
        border-radius: 50% !important;
        animation: doku-spin 0.8s linear infinite !important;
    }

    .doku-payment-container .doku-pay-button.loading .spinner {
        display: block !important;
    }

    .doku-payment-container .doku-pay-button.loading .btn-text,
    .doku-payment-container .doku-pay-button.loading .btn-icon {
        display: none !important;
    }

    @keyframes doku-spin {
        to { transform: rotate(360deg); }
    }

    .doku-payment-container .doku-test-mode-badge {
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

    .doku-payment-container .doku-secure-badge {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        padding: 12px !important;
        background: rgba(255, 255, 255, 0.03) !important;
        border-radius: 8px !important;
    }

    .doku-payment-container .doku-secure-badge svg {
        color: rgb(0, 234, 203) !important;
        width: 16px !important;
        height: 16px !important;
    }

    .doku-payment-container .doku-secure-badge span {
        font-family: "DM Sans", sans-serif !important;
        font-size: 12px !important;
        color: rgba(255, 255, 255, 0.6) !important;
    }

    /* Override SweetAlert2 dark theme */
    .swal2-popup {
        background: rgba(29, 29, 29, 0.95) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px !important;
    }

    .swal2-title {
        font-family: "DM Sans", sans-serif !important;
        font-weight: 700 !important;
        color: #fff !important;
    }

    .swal2-content {
        font-family: "DM Sans", sans-serif !important;
        color: rgba(255, 255, 255, 0.8) !important;
    }

    .swal2-confirm {
        background: linear-gradient(90deg, rgba(0, 83, 72, 1) 0%, rgba(0, 238, 207, 1) 100%) !important;
        font-family: "DM Sans", sans-serif !important;
        font-weight: 600 !important;
        border-radius: 12px !important;
        padding: 12px 24px !important;
    }

    @media screen and (max-width: 768px) {
        .doku-payment-container {
            padding: 20px;
            border-radius: 16px;
        }

        .doku-payment-info h4 {
            font-size: 15px;
        }

        .doku-payment-info p,
        .doku-payment-info ul li {
            font-size: 13px;
        }
    }
</style>

<div class="doku-payment-container">
    @php
        $payment_keys = json_decode($payment_gateway->keys, true);
        $test_mode = $payment_gateway->test_mode == 1;
    @endphp

    @if ($test_mode)
        <div class="doku-test-mode-badge">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            {{ get_phrase('Test Mode Active') }}
        </div>
    @endif

    <div class="doku-payment-info">
        <h4>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12.01" y2="8"></line>
            </svg>
            {{ get_phrase('Payment Information') }}
        </h4>
        <p>{{ get_phrase('You will be redirected to Doku secure payment page where you can complete your payment using:') }}</p>
        <ul>
            <li>{{ get_phrase('Credit/Debit Cards (Visa, Mastercard, JCB)') }}</li>
            <li>{{ get_phrase('Bank Transfers (BCA, Mandiri, BNI, BRI, Permata)') }}</li>
            <li>{{ get_phrase('E-Wallets (OVO, DANA, LinkAja, ShopeePay)') }}</li>
            <li>{{ get_phrase('QRIS Payment') }}</li>
        </ul>
    </div>

    <form id="formRequestData" class="needs-validation" novalidate>
        <button type="submit" class="doku-pay-button">
            <div class="spinner"></div>
            <span class="btn-text">{{ get_phrase('Continue to Doku Payment') }}</span>
            <span class="btn-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </span>
        </button>

        <div class="doku-secure-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <span>{{ get_phrase('Secured by Doku - Your payment information is protected') }}</span>
        </div>
    </form>
</div>

<script>
    $("#formRequestData").submit(function(e) {
        e.preventDefault();

        const $button = $(this).find('button[type="submit"]');
        $button.addClass('loading').prop('disabled', true);

        $.ajax({
            type: "POST",
            url: "{{ route('payment.doku_checkout', ['identifier' => 'doku']) }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            },
            success: function(result) {
                loadJokulCheckout(result.response.payment.url);
                $button.removeClass('loading').prop('disabled', false);
            },
            error: function(xhr, textStatus, error) {
                console.log(error);
                $button.removeClass('loading').prop('disabled', false);
                Swal.fire({
                    icon: 'error',
                    title: '{{ get_phrase("Payment Failed") }}',
                    text: '{{ get_phrase("Unable to process your payment. Please try again.") }}',
                    confirmButtonText: '{{ get_phrase("Close") }}',
                })
            }
        });

        return false;
    });
</script>
