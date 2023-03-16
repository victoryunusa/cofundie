@if(isset($data['headings']['heading.latest-news']))
    @php
    $heading = $data['headings']['heading.latest-news'];
    $posts = $data['posts'] ?? $posts;
    @endphp

    <div class="blog-area bg-gray-cu section-padding-100-50">
        <div class="container">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-70">
                <div class="lg:text-center">
                    <h2 class="text-lg font-semibold text-indigo-600">{{ $heading['short_title'] ?? null }}</h2>
                    <p class="mt-2 text-3xl font-bold capitalize leading-8 tracking-tight text-gray-900 sm:text-4xl">{{ $heading['title'] ?? null }}</p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">{!! $heading['description'] ?? null !!}</p>
                </div>
            </div>

            <div class="grid grid-cols-12 sm:gap-8">
                <!-- Single Card -->
                @foreach ($posts as $post)
                <div class="col-span-12 sm:col-span-6 lg:col-span-4">
                    <div class="single-blog-card mb-50">
                        <div class="blog-image mb-5">
                           <a href="{{ route('frontend.blogs.show', $post->slug) }}"> <img class="rounded-lg" src="{{ $post->preview ? asset($post->preview->value ?? null) : asset('admin/img/img/placeholder.png')}}" alt=""></a>
                        </div>
                        <p class="mb-3 text-violet-800">{{ __('Date') }}: {{ formatted_date($post->created_at) }}</p>
                        <h4 class="text-3xl mb-3">
                            <a href="{{ route('frontend.blogs.show', $post->slug) }}">{{ str($post->title)->words(10, '...') }}</a>
                        </h4>
                        <p class="mb-3">
                           {!! str($post->description->value ?? null)->words(20, '...') !!}
                        </p>
                        <a class="def-btn mt-5 font-medium" href="{{ route('frontend.blogs.show', $post->slug) }}">{{ __('Read More') }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
