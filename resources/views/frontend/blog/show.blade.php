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
                        <p class="text-lg max-w-xl mx-auto">{{ Str::limit($post->description->value ?? '', 100, '...') }}</p>
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
                        <form class="relative mx-auto max-w-xl" action="{{ route('frontend.blogs.index') }}">
                            <input type="text" id="subemail" name="title" class="pt-4 pr-40 pb-4 pl-6 w-full h-[50px] outline-none text-black dark:text-white  bg-white/70 border border-gray-200" placeholder="{{ __('Enter blog title') }}">
                            <button type="submit" class="btn absolute w-32 top-[0] right-[3px] h-[50px] bg-violet-800 hover:bg-violet-500 border-indigo-600 hover:border-indigo-700 text-white">{{ __('Search') }}</button>
                        </form>

                        <h5 class="text-lg font-semibold bg-gray-50 rounded-lg shadow p-2 text-center mt-8"> {{ __('Recent Post') }}</h5>
                        @foreach ($recentPosts as $blog)
                        <div class="flex items-center mt-8 rounded-lg bg-gray-100 p-4">
                            <img src="{{ $post->preview->value ?? null }}" class="h-16 rounded-md shadow " alt="">

                            <div class="ml-3">
                                <a href="{{ route('frontend.blogs.show', $blog->slug) }}" class="hover:text-indigo-600 block mb-2 text-xl">{{ $blog->title }}</a>
                                <p class="mb-4 text-sm">{{ Str::limit($post->description->value ?? '', 80, '...') }}</p>
                                <p class="text-sm text-gray-500">{{ formatted_date($post->created_at) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-8 md:col-span-6">
                    <div class="p-6 rounded-md shadow ">
                        <img src="img/bg-img/7.jpg" class="rounded-md" alt="">

                        <div class="mt-6">
                            {!! $post->description->value ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
            <!--end grid-->
        </div>
    </div>
@endsection
