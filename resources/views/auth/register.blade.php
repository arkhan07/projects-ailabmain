@extends('layouts.auth')
@push('title', get_phrase('Sign Up'))
@push('meta')@endpush
@push('css')
    <style>
        .form-icons .right {
            right: 20px;
            cursor: pointer !important;
        }
    </style>
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
                    <h1 class="auth-title">{{ get_phrase('Bergabung Sekarang') }}</h1>
                    <p class="auth-subtitle">{{ get_phrase('Daftar untuk menjadi bagian dari 1001 AI Pioneers') }}</p>
                </div>

                <form action="{{ route('register') }}" class="auth-form" id="register-form" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">{{ get_phrase('Full Name') }}</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-input"
                            placeholder="{{ get_phrase('Enter your full name') }}"
                            value="{{ old('name') }}"
                            required
                        />
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">{{ get_phrase('Email') }}</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input"
                            placeholder="{{ get_phrase('Enter your email') }}"
                            value="{{ old('email') }}"
                            required
                        />
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">{{ get_phrase('Password') }}</label>
                        <div class="password-wrapper">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-input"
                                placeholder="{{ get_phrase('Create password (min. 8 characters)') }}"
                                minlength="8"
                                required
                            />
                            <button type="button" class="toggle-password" aria-label="Toggle password visibility">
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
                        <p class="form-hint">{{ get_phrase('Minimum 8 characters with combination of letters and numbers') }}</p>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    @if (get_settings('allow_instructor'))
                        <div class="form-group">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" id="instructor" name="instructor" />
                                <span class="checkmark"></span>
                                <span class="checkbox-label">{{ get_phrase('Apply to Become an instructor') }}</span>
                            </label>
                        </div>

                        <div id="become-instructor-fields" class="d-none">
                            <div class="form-group">
                                <label for="phone" class="form-label">{{ get_phrase('Phone') }}</label>
                                <input class="form-input" id="phone" type="tel" name="phone" placeholder="{{ get_phrase('Enter your phone number') }}">
                            </div>
                            <div class="form-group">
                                <label for="document" class="form-label">{{ get_phrase('Document') }} <small>(doc, docs, pdf, txt, png, jpg, jpeg)</small></label>
                                <input class="form-input" id="document" type="file" name="document">
                                <small>{{ get_phrase('Provide some documents about your qualifications') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">{{ get_phrase('Message') }}</label>
                                <textarea class="form-input" id="description" name="description" rows="4" placeholder="{{ get_phrase('Tell us about yourself') }}"></textarea>
                            </div>
                        </div>
                    @endif

                    @if(get_frontend_settings('recaptcha_status'))
                        <div class="g-recaptcha" data-sitekey="{{ get_frontend_settings('recaptcha_sitekey') }}"></div>
                    @endif

                    <button type="submit" class="btn-submit">
                        <span class="btn-text">{{ get_phrase('Sign Up') }}</span>
                        <span class="btn-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </button>
                </form>

                <div class="auth-footer">
                    <p>{{ get_phrase('Already have an account?') }} <a href="{{ route('login') }}" class="auth-link">{{ get_phrase('Sign in here') }}</a></p>
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

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const eyeIcon = this.querySelector('.eye-icon');
                const eyeOffIcon = this.querySelector('.eye-off-icon');

                if (input.type === 'password') {
                    input.type = 'text';
                    eyeIcon.style.display = 'none';
                    eyeOffIcon.style.display = 'block';
                } else {
                    input.type = 'password';
                    eyeIcon.style.display = 'block';
                    eyeOffIcon.style.display = 'none';
                }
            });
        });

        // Show/hide instructor fields
        document.addEventListener('DOMContentLoaded', function() {
            const instructorCheckbox = document.getElementById('instructor');
            const instructorFields = document.getElementById('become-instructor-fields');

            if (instructorCheckbox) {
                instructorCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        instructorFields.classList.remove('d-none');
                        document.getElementById('phone').setAttribute('required', true);
                        document.getElementById('document').setAttribute('required', true);
                    } else {
                        instructorFields.classList.add('d-none');
                        document.getElementById('phone').removeAttribute('required');
                        document.getElementById('document').removeAttribute('required');
                    }
                });
            }
        });
    </script>
@endpush
