@extends('layouts.auth')
@push('title', get_phrase('Email Verification'))
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
                <div class="auth-header">
                    <h1 class="auth-title">{{ get_phrase('Verify Your Email') }}</h1>
                    <p class="auth-subtitle">{{ get_phrase('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}</p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert-success">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        <p>{{ get_phrase('A new verification link has been sent to the email address you provided during registration.') }}</p>
                    </div>
                @endif

                <form action="{{ route('verification.send') }}" class="auth-form" method="POST">
                    @csrf

                    <p class="verify-info">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 20px; display: block;">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        {{ get_phrase("If you didn't receive the email, we will gladly send you another.") }}
                    </p>

                    <button type="submit" class="btn-submit">
                        <span class="btn-text">{{ get_phrase('Resend Verification Email') }}</span>
                        <span class="btn-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="23 4 23 10 17 10"></polyline>
                                <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                            </svg>
                        </span>
                    </button>
                </form>

                <div class="auth-footer">
                    <p>{{ get_phrase("Already verified?") }} <a href="{{ route('login') }}" class="auth-link">{{ get_phrase('Sign in') }}</a></p>
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
@endpush
