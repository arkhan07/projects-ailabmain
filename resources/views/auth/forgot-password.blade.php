@extends('layouts.auth')
@push('title', get_phrase('Forgot Password'))
@push('meta')@endpush
@push('css')
@endpush
@section('content')
    <div class="auth-wrapper">
        <!-- Background Gradient -->
        <div class="bg-gradient bg-gradient-top"></div>
        <div class="bg-gradient bg-gradient-bottom"></div>

        <!-- Auth Container -->
        <div class="auth-container">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="auth-logo">
                <img src="{{ get_image(get_frontend_settings('light_logo')) }}" alt="{{ get_settings('system_name') }} Logo" />
            </a>

            <!-- Auth Card -->
            <div class="auth-card">
                <!-- Icon -->
                <div class="auth-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>

                <div class="auth-header">
                    <h1 class="auth-title">{{ get_phrase('Forgot Password?') }}</h1>
                    <p class="auth-subtitle">{{ get_phrase("No worries! Enter your registered email and we'll send you a link to reset your password.") }}</p>
                </div>

                <!-- Default Form -->
                <form action="{{ route('password.email') }}" class="auth-form" id="forgot-form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">{{ get_phrase('Email') }}</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input"
                            placeholder="{{ get_phrase('Enter registered email') }}"
                            required
                        />
                    </div>

                    <button type="submit" class="btn-submit">
                        <span class="btn-text">{{ get_phrase('Send Reset Link') }}</span>
                        <span class="btn-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                        </span>
                    </button>
                </form>

                <div class="auth-footer">
                    <p>{{ get_phrase('Remember password?') }} <a href="{{ route('login') }}" class="auth-link">{{ get_phrase('Back to Login') }}</a></p>
                </div>
            </div>

            <!-- Back to Home -->
            <a href="{{ route('home') }}" class="back-home">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>{{ get_phrase('Back to Home') }}</span>
            </a>
        </div>
    </div>
@endsection

@push('js')
    <script>
        "use strict";
        // Add any additional JavaScript if needed
    </script>
@endpush
