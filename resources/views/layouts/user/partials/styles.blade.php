<!-- Favicon -->
<link rel="icon" href="{{ asset(get_option('logo_setting', true)->favicon ?? config('app.name')) }}" type="image/png">
<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<!-- Icons -->
<link rel="stylesheet" href="{{ asset('user/vendor/nucleo/css/nucleo.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('user/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
<!-- Argon CSS -->
<link rel="stylesheet" href="{{ asset('user/css/argon.css') }}" type="text/css">

<link rel="stylesheet" href="{{ asset('plugins/toastify-js/src/toastify.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/jquery-confirm-js/jquery-confirm.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('user/custom.css') }}">

@yield('css')
@stack('css')
