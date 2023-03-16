@extends('layouts.frontend.app')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! Twitter::generate() !!}
@endsection

@section('content')
     <!-- Breadcrumb Area Start -->
     <section class="breadcrumb-area py-36  bg-img" style="background-image:url({{ asset('frontend/img/bg-img/5.png') }})">
        <div class="breadcrumb-content-text h-100 flex items-center">
            <div class="container ">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="breadcrumb-text mt-28 col-span-12 text-center">
                        <h4 class="text-5xl mb-3 font-extrabold capitalize">{{ $page->title }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->
    @php
        $info = json_decode($page->page->value);
    @endphp
    <div class="about-us-area section-padding-100-50">
        <div class="container">
            {!! $info->page_content !!}
        </div>
    </div>
@endsection

