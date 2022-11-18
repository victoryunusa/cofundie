@extends('layouts.frontend.app')

@section('title', __('Properties'))

@section('content')
    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area py-36  bg-img" style="background-image:url({{ asset('frontend/img/bg-img/5.png') }})">
        <div class="breadcrumb-content-text h-100 flex items-center">
            <div class="container ">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="breadcrumb-text mt-28 col-span-12 text-center">
                        @if (isset($data['headings']['heading.property']))
                            @php
                                $heading = $data['headings']['heading.property'];
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

    <!-- Featured properties -->
    @include('frontend.partials.projects')
    <!-- Featured properties -->
@endsection
