<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@hasSection('title')@yield('title') |@endif {{ config('app.name') }}</title>
    @include('layouts.user.partials.styles')
</head>
<body>
@yield('body')
@include('layouts.user.partials.scripts')
</body>
</html>
