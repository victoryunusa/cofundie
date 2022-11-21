@extends('layouts.frontend.master')

@section('title', __('Login'))

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
                        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"> {{ __('Sign In to your account') }} </h2>
                    </div>

                    <form class="mt-8 space-y-6 ajaxform_instant_reload" action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="rounded-md shadow-sm">
                            <div class="mb-4">
                                <label for="email-address" class="sr-only">{{ __('Email address') }}</label>
                                <input id="email-address" name="email" type="email" autocomplete="email" required class="relative block w-full  form-control p-4 border-2 rounded-md" placeholder="{{ __('Email address') }}">
                            </div>

                            <div>
                                <label for="password" class="sr-only">{{ __('Password') }}</label>
                                <input id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full form-control p-4 border-2 rounded-md" placeholder="{{ __('Password') }}">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <label for="remember-me" class="ml-1 block text-sm text-gray-900">{{ __('Remember me') }}</label>
                            </div>

                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">{{ __('Forgot password?') }}</a>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-violet-800 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 submit-btn">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-violet-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                {{ __('Sign in') }}
                            </button>
                        </div>
                        <div class="text-center">
                            <div class="text-sm">
                                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">{{ __("Don't have an account?") }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
