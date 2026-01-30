<style>
    .auth-toast {
        position: fixed;
        top: 24px;
        right: 24px;
        max-width: 400px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border-radius: 12px;
        padding: 16px 20px;
        border: 1px solid rgba(52, 199, 89, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
        z-index: 99999;
        animation: slideInRight 0.3s ease-out;
    }

    .auth-toast.success {
        border-color: rgba(52, 199, 89, 0.5);
        background: rgba(52, 199, 89, 0.1);
    }

    .toast-content {
        display: flex;
        align-items: start;
        gap: 12px;
    }

    .toast-icon {
        flex-shrink: 0;
        width: 24px;
        height: 24px;
        color: #34c759;
    }

    .toast-text {
        flex: 1;
    }

    .toast-title {
        font-size: 14px;
        font-weight: 600;
        color: #34c759;
        margin: 0 0 4px 0;
    }

    .toast-message {
        font-size: 13px;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
        line-height: 1.5;
    }

    .toast-close {
        flex-shrink: 0;
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.6);
        cursor: pointer;
        padding: 0;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
    }

    .toast-close:hover {
        color: rgba(255, 255, 255, 1);
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    @media (max-width: 575px) {
        .auth-toast {
            right: 16px;
            left: 16px;
            max-width: none;
        }
    }
</style>

<div class="auth-toast success" id="auth-toast-success">
    <div class="toast-content">
        <svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="16 8 10 14 8 12"></polyline>
        </svg>
        <div class="toast-text">
            <p class="toast-title">{{ get_phrase('Success!') }}</p>
            <p class="toast-message">{{ Session::get('success') }}</p>
        </div>
        <button type="button" class="toast-close" onclick="closeToast('auth-toast-success')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
</div>

<script>
    function closeToast(id) {
        const toast = document.getElementById(id);
        if (toast) {
            toast.style.animation = 'slideOutRight 0.3s ease-out';
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    }

    // Auto close after 6 seconds
    setTimeout(() => {
        closeToast('auth-toast-success');
    }, 6000);
</script>
