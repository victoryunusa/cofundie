@extends('layouts.frontend.app')

@section('content')
<!-- Breadcrumb Area Start -->
<section class="breadcrumb-area py-36  bg-img" style="background-image:url({{ asset('frontend/img/bg-img/5.png') }})">
    <div class="breadcrumb-content-text h-100 flex items-center">
        <div class="container ">
            <div class="grid grid-cols-12 gap-4 items-center">
                <div class="breadcrumb-text mt-28 col-span-12 text-center">
                    @if(isset($data['headings']['heading.contacts']))
                        @php
                        $heading = $data['headings']['heading.contacts'];
                        @endphp
                        <h4 class="text-5xl mb-3 font-extrabold capitalize">{{ $heading['page_title'] ?? null }}</h4>
                        <p class="text-lg max-w-xl mx-auto">{{ $heading['page_description'] ?? null }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<div class="contact-area section-padding-100-50">
    <div class="container">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-70">
            <div class="lg:text-center">
                @if(isset($data['headings']['heading.contacts']))
                    @php
                    $heading = $data['headings']['heading.contacts'];
                    @endphp
                    <h2 class="text-lg font-semibold text-indigo-600">{{ $heading['short_title'] ?? null }}</h2>
                    <p class="mt-2 text-3xl font-bold leading-8 tracking-tight text-gray-900 sm:text-4xl">{{ $heading['title'] ?? null }}</p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">{{ $heading['description'] ?? null }}</p>
                @endif
            </div>
        </div>

        <form action="{{ route('frontend.contacts.store') }}" method="POST" class="grid grid-cols-12 sm:gap-8 ajaxform_reset_form">
            @csrf

            <div class="col-span-12 sm:col-span-6 mb-50 bg-gray-100 px-8 py-12 rounded-lg">
                <div class="text-left mb-6">
                    <label for="name" class="font-semibold">{{ __('Your Name') }}:</label>
                    <div class="form-icon relative mt-3">
                        <input name="name" id="name" type="text" class="form-input pl-5 w-full border rounded-md border-slate-200 h-14" placeholder="{{ __('Name') }} :">
                    </div>
                </div>

                <div class="text-left mb-6">
                    <label for="email" class="font-semibold">{{ __('Your Email') }}:</label>
                    <div class="form-icon relative mt-3">
                        <input name="email" id="email" type="email" class="form-input pl-5 w-full border rounded-md border-slate-200 h-14" placeholder="{{ __('Email') }} :">
                    </div>
                </div>

                <div class="text-left mb-6">
                    <label for="message" class="font-semibold">{{ __('Your Comment') }}:</label>
                    <div class="form-icon relative mt-3">
                        <textarea name="message" id="message" class="form-input pl-11 pt-5 w-full border rounded-md border-slate-200 h-32" placeholder="{{ __('Message') }} :"></textarea>
                    </div>
                </div>

                <button type="submit" id="submit" name="send" class="btn bg-violet-800 hover:bg-violet-500 border-indigo-600 hover:border-indigo-700 p-4 text-white rounded-md w-full">{{ __('Send Message') }}</button>
            </div>

            <div class="col-span-12 sm:col-span-6 mb-50">
                @if(isset($data['headings']['heading.contacts']))
                    @php
                    $heading = $data['headings']['heading.contacts'];
                    @endphp
                    <div class="text-center px-6">
                        <div class="w-20 h-20 bg-violet-600/5 text-violet-600 rounded-xl text-3xl flex align-middle justify-center items-center shadow-sm mx-auto">
                            <i class="{{ $heading['phone_icon'] ?? 'fas fa-phone' }}"></i>
                        </div>

                        <div class="content mt-7">
                            <h5 class="title h5 text-xl font-medium">{{ $heading['phone_title'] ?? null }}</h5>
                            <p class="text-slate-400 mt-3">{{ $heading['phone_description'] ?? null }}</p>

                            <div class="mt-5">
                                <a href="tel:{{ $heading['phone_number'] ?? null }}" class="btn btn-link text-violet-600 hover:text-violet-600 after:bg-violet-600 duration-500 ease-in-out">{{ $heading['phone_number'] ?? null }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center px-8 mt-12">
                        <div class="w-20 h-20 bg-violet-600/5 text-violet-600 rounded-xl text-3xl flex align-middle justify-center items-center shadow-sm mx-auto">
                            <i class="{{ $heading['email_icon'] ?? 'far fa-envelope' }}"></i>
                        </div>

                        <div class="content mt-7">
                            <h5 class="title h5 text-xl font-medium">{{ $heading['email_title'] ?? null }}</h5>
                            <p class="text-slate-400 mt-3">{{ $heading['email_description'] ?? null }}</p>

                            <div class="mt-5">
                                <a href="mailto:{{ $heading['email_number'] ?? null }}" class="btn btn-link text-violet-600 hover:text-violet-600 after:bg-violet-600 duration-500 ease-in-out">{{ $heading['email_number'] ?? null }}</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
