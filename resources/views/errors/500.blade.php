@extends('layouts.auth')
@push('title', get_phrase('500 Server Error'))
@push('meta')@endpush
@push('css')@endpush
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
                    <h1 class="auth-title">{{ get_phrase('500 Server Error') }}</h1>
                    <p class="auth-subtitle">{{ get_phrase('A technical error has occurred') }}</p>
                </div>

                <div class="error-content">
                    <div class="error-icon">
                        <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>

                    <div class="error-message">
                        <p class="error-title">{{ get_phrase('Something went wrong') }}</p>
                        <p class="error-text">{{ get_phrase('We are experiencing technical difficulties. Please try again later') }}.</p>

                        @php
                            $contact_info = json_decode(get_frontend_settings('contact_info'), true);
                        @endphp

                        @if (is_array($contact_info) && array_key_exists('email', $contact_info))
                        <div class="error-contact">
                            <p class="error-contact-label">{{ get_phrase('Need help') }}?</p>
                            <p class="error-contact-value">{{ get_phrase('Contact us at') }}: {{ $contact_info['email'] }}</p>
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('home') }}" class="btn-submit">
                        <span class="btn-text">{{ get_phrase('Back to Home') }}</span>
                        <span class="btn-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
