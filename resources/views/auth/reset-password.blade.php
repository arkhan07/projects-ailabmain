@extends('layouts.auth')
@push('title', get_phrase('Reset Password'))
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
                        <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                        <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                        <line x1="12" y1="19" x2="12" y2="23"></line>
                        <line x1="8" y1="23" x2="16" y2="23"></line>
                    </svg>
                </div>

                <div class="auth-header">
                    <h1 class="auth-title">{{ get_phrase('Reset Password') }}</h1>
                    <p class="auth-subtitle">{{ get_phrase('Create a new secure password for your account') }}</p>
                </div>

                <form action="{{ route('password.store') }}" class="auth-form" id="reset-form" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="form-group">
                        <label for="email" class="form-label">{{ get_phrase('Email') }}</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input"
                            value="{{ old('email', $request->email) }}"
                            placeholder="{{ get_phrase('Enter your email') }}"
                            required
                            autofocus
                        />
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">{{ get_phrase('New Password') }}</label>
                        <div class="password-wrapper">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input"
                                placeholder="{{ get_phrase('Enter new password') }}"
                                required
                            />
                            <button type="button" class="toggle-password" aria-label="Toggle password visibility" onclick="togglePasswordVisibility('password')">
                                <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="eye-off-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                        <small class="form-hint">{{ get_phrase('Password must be at least 8 characters long') }}</small>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">{{ get_phrase('Confirm Password') }}</label>
                        <div class="password-wrapper">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-input"
                                placeholder="{{ get_phrase('Confirm new password') }}"
                                required
                            />
                            <button type="button" class="toggle-password" aria-label="Toggle password visibility" onclick="togglePasswordVisibility('password_confirmation')">
                                <svg class="eye-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg class="eye-off-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display: none;">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span class="btn-text">{{ get_phrase('Reset Password') }}</span>
                        <span class="btn-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="20 6 9 17 4 12"></polyline>
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

        function togglePasswordVisibility(inputId) {
            const wrapper = document.getElementById(inputId).closest('.password-wrapper');
            const input = wrapper.querySelector('input');
            const eyeIcon = wrapper.querySelector('.eye-icon');
            const eyeOffIcon = wrapper.querySelector('.eye-off-icon');

            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.style.display = 'none';
                eyeOffIcon.style.display = 'block';
            } else {
                input.type = 'password';
                eyeIcon.style.display = 'block';
                eyeOffIcon.style.display = 'none';
            }
        }
    </script>
@endpush
