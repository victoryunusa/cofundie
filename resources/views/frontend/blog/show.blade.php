@extends('layouts.frontend.app')

@section('title', __('Blog Details'))

@section('content')
    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area py-36  bg-img" style="background-image:url({{ asset('frontend/img/bg-img/5.png') }})">
        <div class="breadcrumb-content-text h-100 flex items-center">
            <div class="container ">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="breadcrumb-text mt-28 col-span-12 text-center">
                        <h4 class="text-5xl mb-3 font-extrabold capitalize">{{ $post->title ?? null }}</h4>
                        <p class="text-lg max-w-xl mx-auto">{!! Str::limit($post->description->value ?? '', 150, '...') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->

    <!-- Blog Details Area -->
    <div class="blog-details-area section-padding-100-50">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] mb-50">
                <div class="lg:col-span-4 md:col-span-6 mb-50">
                    <div class="sticky top-20">
                       

                        <h5 class="text-lg font-semibold bg-gray-50 rounded-lg shadow p-2 text-center mt-8"> {{ __('Recent Post') }}</h5>
                        @foreach ($recentPosts as $blog)
                        <div class="flex items-center mt-8 rounded-lg bg-gray-100 p-4">
                            <img src="{{ $blog->preview->value ?? null }}" class="h-16 rounded-md shadow " alt="">

                            <div class="ml-3">
                                <a href="{{ route('frontend.blogs.show', $blog->slug) }}" class="hover:text-indigo-600 block mb-2 text-xl">{{ $blog->title }}</a>
                                <p class="mb-4 text-sm">{!! Str::limit($post->description->value ?? '', 80, '...') !!}</p>
                                <p class="text-sm text-gray-500">{{ formatted_date($post->created_at) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-8 md:col-span-6">
                    <div class="p-6 rounded-md shadow ">
                        <img src="{{ $post->preview->value ?? null }}" class="rounded-md" alt="">

                        <div class="mt-6">
                            <h2 class="2xl:text-4xl text-3xl mb-4">
                                {{ $post->title }}
                            </h2>
                            {!! $post->description->value ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
            <!--end grid-->
        </div>
    </div>
@endsection
