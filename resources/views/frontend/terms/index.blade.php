@extends('layouts.frontend.app')

@section('content')
    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area py-36  bg-img" style="background-image:url({{ asset('frontend/img/bg-img/5.png') }})">
        <div class="breadcrumb-content-text h-100 flex items-center">
            <div class="container ">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="breadcrumb-text mt-28 col-span-12 text-center">
                        @if(isset($data['headings']['heading.terms']))
                            @php
                            $heading = $data['headings']['heading.terms'];
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

    @if(isset($data['headings']['heading.terms']))
        @php
        $heading = $data['headings']['heading.terms'];
        @endphp
        <!-- Faq Area -->
        <div class="faq-area bg-gray-cu section-padding-100-50">
            <div class="container">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-70">
                    <div class="lg:text-center">
                        <h2 class="text-lg font-semibold text-indigo-600">{{ $heading['short_title'] ?? null }}</h2>
                        <p class="mt-2 text-3xl font-bold leading-8 tracking-tight text-gray-900 sm:text-4xl">{{ $heading['title'] ?? null }}
                        </p>
                        <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">{{ $heading['description'] ?? null }}</p>
                    </div>
                </div>

                <div class="card mb-50">
                    <!--end card-header-->
                    <div class="card-body">
                        <div class="grid grid-cols-12 gap-4">
                            @foreach ($data['faqs'] as $faq)
                            <div class="col-span-6">
                                <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white bg-gray-50 text-gray-900" data-inactive-classes="text-gray-500 dark:text-gray-400">
                                    <h2 id="accordion-flush-heading-{{ $loop->index }}">
                                        <button type="button" class="flex justify-between items-center text-xl p-5 w-full realston text-left text-gray-500 border-b border-dashed border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                            data-accordion-target="#accordion-flush-body-{{ $loop->index }}" aria-expanded="{{ $loop->first || $loop->index == 1 ? 'true':'false' }}" aria-controls="accordion-flush-body-{{ $loop->index }}">
                                            <span>{{ $faq->value['question'] ?? '' }}</span>
                                            <i class="fas fa-angle-down" data-accordion-icon></i>
                                        </button>
                                    </h2>
                                    <div id="accordion-flush-body-{{ $loop->index }}" class="hidden" aria-labelledby="accordion-flush-heading-{{ $loop->index }}">
                                        <div class="p-5 border-b border-dashed border-gray-200 dark:border-gray-700">
                                            <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $faq->value['answer'] ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
            </div>
        </div>
        <!-- Faq Area -->
    @endif

    <!-- Terms Area -->
    <div class="privacy-content-area section-padding-100">
        <div class="container">
            <div class="grid grid-cols-12">
                <div class="col-span-12">
                    <div class="terms-content-text">
                        {!! $heading['contents'] ?? null !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Terms Area -->
@endsection

@push('script')
    <script src="{{ asset('frontend/js/components.js') }}"></script>
@endpush
