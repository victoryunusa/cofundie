@extends('layouts.frontend.master')

@section('title', __('Reset Password'))
@php
    $logo = get_option('logo_setting');
@endphp

@section('body')
    <div class="h-screen flex items-center justify-center bg-img" style="background-image:url({{ asset('frontend/img/bg-img/5.png') }})">
        <div class="login-reg-area flex items-center justify-center h-min">
            <div class="auth-content flex items-center justify-center">
                <div class="auth-content-text bg-white px-8 py-12 rounded-lg">

                    <div>
                        <a href="{{ url('/') }}">
                            <img class="mx-auto h-8 w-44" src="{{ $logo['logo'] ?? null }}" alt="Workflow">
                        </a>
                        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"> {{ __('Reset Password') }} </h2>
                    </div>
                    @if (session('status'))
                    <div class="text-red-600" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
                        @csrf

                        <div class="rounded-md shadow-sm">
                            <div class="mb-4">
                                <label for="email-address" class="sr-only">{{ __('Email address') }}</label>
                                <input id="email-address" name="email" type="email" autocomplete="email" required class="relative block w-full  form-control p-4 border-2 rounded-md" placeholder="{{ __('Email address') }}">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-violet-800 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 submit-btn">
                                
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection