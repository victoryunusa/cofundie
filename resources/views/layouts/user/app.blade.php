@extends('layouts.user.master')

@section('body')
    @include('layouts.user.partials.sidenav')

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        @include('layouts.user.partials.topnav')

        @include('layouts.user.partials.header')

        <!-- Page content -->
        <div class="container-fluid mt--6">
            @yield('content')

            @include('layouts.user.partials.footer')
        </div>
    </div>
    @yield('modal')
@endsection
