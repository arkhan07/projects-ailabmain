<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.seo')
    @stack('meta')

    <!-- fav icon -->
    <link rel="shortcut icon" href="{{ asset(get_frontend_settings('favicon')) }}" />

    <!-- Fontawasome Css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/default/css/all.min.css') }}">

    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/default/css/bootstrap.min.css') }}">

    <!-- Landingpage Auth Styles -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/default/landingpage/globals.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/default/landingpage/styleguide.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/default/landingpage/auth.css') }}">

    <!-- Jquery Js -->
    <script src="{{ asset('assets/frontend/default/js/jquery-3.7.1.min.js') }}"></script>
    @stack('css')

</head>

<body>
    @yield('content')

    <!-- Jquery Scripts -->
    <script src="{{ asset('assets/frontend/default/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/default/js/bootstrap.bundle.min.js') }}"></script>

    @if(get_frontend_settings('recaptcha_status'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    @stack('js')

    @if (Session::has('error'))
        @include('frontend.default.toaster.error')
    @endif

    @if (Session::has('success'))
        @include('frontend.default.toaster.success')
    @endif

    @if (Session::has('warning'))
        @include('frontend.default.toaster.warning')
    @endif

    @if (Session::has('info'))
        @include('frontend.default.toaster.info')
    @endif

    @if ($errors->any())
        @include('frontend.default.toaster.error')
    @endif
</body>

</html>
