@extends('layouts.frontend.app')

@section('content')
    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area py-36 bg-img" style="background-image:url({{ asset('frontend/img/bg-img/5.png') }})">
        <div class="breadcrumb-content-text h-100 flex items-center">
            <div class="container ">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="breadcrumb-text mt-28 col-span-12 text-center">
                        @if(isset($data['headings']['heading.how-works']))
                            @php
                            $heading = $data['headings']['heading.how-works'];
                            @endphp
                            <h4 class="text-5xl mb-3 font-extrabold capitalize">{{ $heading['title'] ?? null }}</h4>
                            <p class="text-lg max-w-xl mx-auto">{{ $heading['description'] ?? null }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->

    @if(isset($data['headings']['heading.your-portfolio']))
        @php
        $heading = $data['headings']['heading.your-portfolio'];
        @endphp
        <!-- How Works Area -->
        <div class="how-it-works section-padding-100-50">
            <div class="container">
                <div class="grid grid-cols-12 lg:gap-12">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="about-content-text mb-50">
                            <h6 class="text-xl uppercase mb-3">{{ $heading['short_title'] ?? null }}</h6>
                            <h2 class="text-3xl sm:text-5xl lg:text-4xl xl:text-5xl capitalize mb-6 font-extrabold">{{ $heading['title'] ?? null }}</h2>
                            <p class="mb-5">{{ $heading['description'] ?? null }}</p>
                            <h6 class="text-violet-800 text-xl lg:text-base">{{ $heading['suggestions'] ?? null }} <i class="fas fa-long-arrow-alt-right"></i></h6>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="col-span-12 lg:col-span-6">
                        <div class="about-image float-bob-y mb-50">
                            <img src="{{ asset($heading['image'] ?? 'frontend/img/bg-img/11.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- How Works Area -->
    @endif

    @if(isset($data['headings']['heading.feature']))
        @php
        $heading = $data['headings']['heading.feature'];
        @endphp
        <div class="feature-area relative section-padding-100-50 bg-gray-cu">
            <div class="container">
                <div class="grid grid-cols-12 lg:gap-8">
                    <div class="col-span-12 lg:col-span-4">
                        <div class="single-feature-card relative mb-50 rounded-lg bg-white px-7 py-10" data-aos="fade-up"
                            data-aos-duration="400">
                            <div class="flex items-center mb-6">
                                <div class="feature-image mr-6">
                                    <img src="{{ asset($heading['feature_1_icon'] ?? 'frontend/img/icons/1.png') }}" alt="">
                                </div>
                                <h4 class="text-2xl">{{ $heading['feature_1_text'] ?? null }}</h4>
                            </div>
                            <p>{{ $heading['feature_1_description'] ?? null }}</p>
                            <a class="def-btn mt-5 font-medium" href="{{ $heading['feature_1_btn_url'] ?? null }}">{{ $heading['feature_1_btn_text'] ?? null }}</a>
                            <div class="bg-shape-2">
                                <img src="{{ asset($heading['feature_1_bg'] ?? 'frontend/img/icons/5.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <div class="single-feature-card relative mb-50 rounded-lg bg-white px-7 py-10" data-aos="fade-up"
                            data-aos-duration="400">
                            <div class="flex items-center mb-6">
                                <div class="feature-image mr-6">
                                    <img src="{{ asset($heading['feature_2_icon'] ?? 'frontend/img/icons/2.png') }}" alt="">
                                </div>
                                <h4 class="text-2xl">{{ $heading['feature_2_text'] ?? null }}</h4>
                            </div>
                            <p>{{ $heading['feature_2_description'] ?? null }}</p>
                            <a class="def-btn mt-5 font-medium" href="{{ $heading['feature_2_btn_url'] ?? null }}">{{ $heading['feature_2_btn_text'] ?? null }}</a>
                            <div class="bg-shape-2">
                                <img src="{{ asset($heading['feature_2_bg'] ?? 'frontend/img/icons/2.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <div class="single-feature-card relative mb-50 rounded-lg bg-white px-7 py-10" data-aos="fade-up"
                            data-aos-duration="400">
                            <div class="flex items-center mb-6">
                                <div class="feature-image mr-6">
                                    <img src="{{ asset($heading['feature_3_icon'] ?? 'frontend/img/icons/3.png') }}" alt="">
                                </div>
                                <h4 class="text-2xl">{{ $heading['feature_3_text'] ?? null }}</h4>
                            </div>
                            <p>{{ $heading['feature_3_description'] ?? null }}</p>
                            <a class="def-btn mt-5 font-medium" href="{{ $heading['feature_3_btn_url'] ?? null }}">{{ $heading['feature_3_btn_text'] ?? null }}</a>
                            <div class="bg-shape-2">
                                <img src="{{ asset($heading['feature_3_bg'] ?? 'frontend/img/icons/3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Feature Area -->
    @if(isset($data['headings']['heading.our-assets']))
        @php
        $heading = $data['headings']['heading.our-assets'];
        @endphp
    <!-- How Works Area -->
    <div class="how-it-works section-padding-100-50">
        <div class="container">
            <div class="grid grid-cols-12 md:gap-12">
                <!-- Image -->
                <div class="col-span-12 lg:col-span-6">
                    <div class="about-image float-bob-y mb-50">
                        <img src="{{ asset($heading['animate_image'] ?? 'frontend/img/bg-img/12.png') }}" alt="">
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="about-content-text mb-50">
                        <h6 class="text-xl uppercase mb-3">{{ $heading['short_title'] ?? null }}</h6>
                        <h2 class="text-3xl sm:text-5xl lg:text-4xl xl:text-5xl capitalize mb-6 font-extrabold">{{ $heading['title'] ?? null }}</h2>
                        <p class="mb-5">{{ $heading['description'] ?? null }}</p>
                        <h6 class="text-violet-800 text-xl lg:text-base">{{ $heading['suggestions'] ?? null }} <i class="fas fa-long-arrow-alt-right"></i></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- How Works Area -->
    @endif
@endsection
