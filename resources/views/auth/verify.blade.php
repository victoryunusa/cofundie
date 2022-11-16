@extends('layouts.frontend.master')

@section('title', __('Verify your email ✉️'))

@php
    $logo = get_option('logo_setting');
@endphp

@section('body')
    <div class="h-screen flex items-center justify-center bg-img text-center h-100vh w-100" style="background-image:url({{ asset('frontend/img/bg-img/5.png') }})">
        <div class="auth-content flex items-center justify-center">
            <div class="auth-content-text verify-card bg-white px-8 py-12 rounded-lg">

                <div class="mb-10">
                    <a href="{{ url('/') }}">
                        <img class="mx-auto h-8 w-44" src="{{ $logo['logo'] ?? null }}" alt="Workflow">
                    </a>
                </div>

                <form method="POST" action="{{ route('verification.resend') }}" class="ajaxform_instant_reload text-center">
                    @csrf

                    <div class="mt-5">
                        {!! __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') !!}
                    </div>

                    <button type="submit" class="btn btn-light mt-7 w-100 submit-btn">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}" id="logout">
                    @csrf

                    <div class="text-center mt-5">
                        <a class="rounded-md border border-transparent bg-violet-800 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" href="javascript:void(0)" onclick="document.getElementById('logout').submit()">{{ __('Logout') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
