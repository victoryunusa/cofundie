
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>@hasSection('title')@yield('title') |@endif {{ config('app.name') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ get_option('logo_setting', true)->favicon }}">
    <!-- Import css File -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('plugins/toastify-js/src/toastify.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tailwind.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom-file.css') }}">
    @stack('style')
</head>

<body>

    @yield('body')
    @stack('modal')

    <!-- **** All JS Files ***** -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('frontend/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tilt.jquery.js') }}"></script>
    <script src="{{ asset('frontend/js/main-menu.js') }}"></script>
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="{{ asset('plugins/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- Active -->
    <script src="{{ asset('frontend/js/default-assets/active.js') }}"></script>
    <script src="{{ asset('plugins/custom/Notify.js') }}"></script>
    <script src="{{ asset('plugins/custom/custom.js') }}"></script>
    <script src="{{ asset('plugins/custom/form.js') }}"></script>

    @stack('script')

    <script>
        AOS.init();
    </script>

    @if(session('success'))
    <script>
        Notify.success(null, '{{ Session::get('success') }}')
    </script>
    @endif

    @if(Session::has('warning'))
    <script>
        Notify.warning(null, '{{ Session::get('warning') }}')
    </script>
    @endif

    @if(Session::has('error'))
    <script>
        Notify.error(null, '{{ Session::get('error') }}')
    </script>
    @endif
</body>
</html>
