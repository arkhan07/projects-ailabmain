@extends('layouts.auth')
@push('title', get_phrase('404 Not Found'))
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
                    <h1 class="auth-title">{{ get_phrase('404 Not Found') }}</h1>
                    <p class="auth-subtitle">{{ get_phrase('The page you requested could not be found') }}</p>
                </div>

                <div class="error-content">
                    <div class="error-icon">
                        <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>

                    <div class="error-message">
                        <p class="error-title">{{ get_phrase('Oops! Page not found') }}</p>
                        <p class="error-text">{{ get_phrase('Please try the following') }}:</p>
                        <ul class="error-list">
                            <li>{{ get_phrase('Check the spelling of the URL') }}</li>
                            <li>{{ get_phrase('Return to the homepage and try again') }}</li>
                            <li>{{ get_phrase('Use the navigation menu to find what you need') }}</li>
                        </ul>
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
@push('js')
@endpush
