<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>@hasSection('title')@yield('title') |@endif {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ get_option('logo_setting', true)->favicon }}">

    <!-- Import css File -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastify-js/src/toastify.css') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">


    <link rel="stylesheet" href="{{ asset('frontend/custom.css') }}">

</head>

<body class="bg-gray-cu">

@include('layouts.frontend.partials.preloader')

@yield('form')

<!-- **** All JS Files ***** -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<!-- Active -->
<script src="{{ asset('frontend/js/default-assets/active.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/toastify-js/src/toastify.js') }}"></script>

<script src="{{ asset('plugins/custom/Notify.js') }}"></script>
<script src="{{ asset('plugins/custom/custom.js') }}"></script>
<script src="{{ asset('plugins/custom/form.js') }}"></script>
</body>
</html>
