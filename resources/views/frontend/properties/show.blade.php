@extends('layouts.frontend.app')

@section('content')
    <!-- Breadcrumb Area Start -->
    <section class="breadcrumb-area bg-overlay  bg-img" style="background-image:url({{ asset($property->thumbnail ?? 'frontend/img/bg-img/8.jpg') }})">
        <div class="breadcrumb-content-text h-100 flex items-end">
            <div class="container">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 sm:col-span-6 mb-5 sm:mb-10">
                        <div class="breadcrumb-text col-span-12">
                            <span class="text-xl sm:text-2xl md:text-4xl mb-3 block font-medium text-white capitalize">{{ $property->title }}</span>
                            <p class="text-white mb-0"><i class="fas fa-location-arrow text-sm mr-1"></i> {{ $property->address }}</p>
                        </div>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <div class="breadcrumb-text col-span-12 mb-10 sm:text-right relative z-30">
                           <span class="text-xl sm:text-2xl md:text-2xl mb-5 block font-medium text-white capitalize">{{ $property->min_invest }} {{ default_currency()->code.' (Min Amount)' }}</span>

                           <a href="{{ route('user.invests.plans', ['trigger' => 'invest-modal', 'project_id' => $property->id, 'payment' => 'yes']) }}" class="invest-now rounded-md border border-transparent hero-btn-2 py-3 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none">
                                {{ __('Invest Now') }}
                            </a>
                            <a href="{{ route('user.invests.plans', ['trigger' => 'invest-modal', 'project_id' => $property->id]) }}" class="invest-now rounded-md def-btn-2 py-3 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none">
                                {{ __('Invest Using Balance') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Area End -->

    <!-- Project Details Area -->
    <div class="project-details-area section-padding-100-50">
        <div class="container">
            <div class="grid grid-cols-12 lg:gap-7">
                <div class="col-span-12 lg:col-span-8">
                    <div class="project-details-content">
                        <div class="shadow mb-5 p-7 rounded-lg">
                            <h4 class="text-3xl mb-4">{{ __('Key Details') }}</h4>
                            <div class="property-footer border-b-2 pt-4">
                                <div class="flex justify-between items-center">
                                    <div class="po-bottom-card mb-3">
                                        <h5 class="text-lg mb-1">{{ __('Min Invest Amount') }}</h5>
                                        <p class="text-violet-800">{{ currency_format($property->min_invest) }}</span></p>
                                    </div>

                                    <div class="po-bottom-card text-right mb-3">
                                        <h5 class="text-lg mb-1">{{ __('Max Invest Amount') }}</h5>
                                        <p class="text-violet-800">{{ currency_format($property->max_invest) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="property-footer border-b-2 pt-4">
                                <div class="flex justify-between items-center">
                                    <div class="po-bottom-card mb-3">
                                        <h5 class="text-lg mb-1">{{ __('Profit Range') }}</h5>
                                        <p class="text-green-600">{{ $property->profit_range }} <span>({{ $property->invest_type ? '%':'Fixed' }})</span></p>
                                    </div>
                                    <div class="po-bottom-card text-right mb-3">
                                        <h5 class="text-lg mb-1">{{ __('Loss Range') }}</h5>
                                        <p class="text-red-600">{{ $property->loss_range }} <span>({{ $property->invest_type ? '%':'Fixed' }})</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="property-footer pt-4 pb-3">
                                <div class="flex justify-between items-center">
                                    <div class="po-bottom-card">
                                        <h5 class="text-lg mb-1">{{ __('Return For') }}</h5>
                                        <p class="text-red-600">{{ $property->is_period ? ucfirst($property->period_duration) : "Lifetime" }}</span></p>
                                    </div>

                                    <div class="po-bottom-card text-right">
                                        <h5 class="text-lg mb-1">{{ __('Capital Back') }}</h5>
                                        <p class="text-green-600">{{ $property->capital_back ? 'Yes':'No' }}</span></p>
                                    </div>
                                </div>
                            </div>

                            <h4 class="text-2xl mb-4 mt-8">{{ __('Property Amenities') }}</h4>
                            <div class="card-body mb-8">
                                @foreach ($property->meta->value['icon'] ?? '' as $key => $icon)
                                    <li class="nav-link float-left"><i class="{{ $icon }}"></i> {{ $property->meta->value['item'][$key] }}</li>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-gray-100 shadow p-7 rounded-lg">
                            <h4 class="text-3xl mb-4">{{ __('Property Description') }}</h4>
                            <p class="mb-5">{!! $property->meta->value['description'] ?? '' !!}</p>
                        </div>

                        <div class="grid grid-cols-12 sm:gap-8">
                            <div class="col-span-12 mb-10 mt-10">
                                <h2 class="text-2xl capitalize mb-7">{{ __('Gallery Area') }}</h2>
                                <div class="gallery-slider owl-carousel">
                                    @foreach ($property->meta->value['galleries'] ?? '' as $image)
                                    <div class="single-slider">
                                        <a href="javascript:void(0)"><img class="rounded-md" src="{{ $image }}" alt=""></a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-span-12">
                                <div class="card mb-50">
                                    <!--end card-header-->
                                    <div class="card-bodY">
                                        <h4 class="text-xl mb-7 bg-slate-50 px-3 py-4 rounded-lg">{{ __('Frequently asked questions') }}:</h4>
                                        @foreach ($faqs as $faq)
                                            <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white bg-gray-50 text-gray-900" data-inactive-classes="text-gray-500 dark:text-gray-400">
                                                <h2 id="accordion-flush-heading-{{ $loop->index }}">
                                                    <button type="button" class="flex justify-between items-center text-xl p-5 w-full realston text-left text-gray-500 border-b border-dashed border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                                        data-accordion-target="#accordion-flush-body-{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true':'false' }}" aria-controls="accordion-flush-body-{{ $loop->index }}">
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
                                        @endforeach
                                    </div>
                                    <!--end card-body-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4">
                    <div class="invest-form px-7 py-9 shadow-md rounded-xl mb-50 shadow-violate-500/50">
                        <div class="bg-violet-800 py-6 px-4 text-center text-white rounded-lg">
                            <h4 class="text-2xl capitalize mb-3"> {{ __('Calculate Invest Amount') }}</h4>
                            <p>{{ __('Available for funding') }} : <span class="text-green-400 text-lg">{{ currency_format($available_blnc) }}</span></p>
                        </div>

                        <form class="space-y-6 mt-5 ajaxform_instant_reload" action="{{ route('user.invests.payment') }}" method="POST">
                            @csrf

                            <input type="hidden" name="project_id" value="{{ $property->id }}">
                            <div class="rounded-md shadow-sm">
                                <div class="">
                                    <input id="name-address" name="amount" type="number" autocomplete="text" data-max="{{ $property->max_invest }}" data-min="{{ $property->min_invest }}" required class="invest-amount relative block w-full form-control p-4 border-2 rounded-md uppercase" placeholder="{{ __('Enter invest amount') }}">
                                </div>
                            </div>
                            <small><i class="fa fa-info-circle" aria-hidden="true"></i> {{ __('Min-Max Invest Amount') }} {{ $property->min_invest }} {{ default_currency()->code }}</small>

                            <div class="shadow p-4 rounded-md">
                                <div class="property-footer border-b-2 mb-3">
                                    <div class="flex justify-between items-center">
                                        <div class="po-bottom-card mb-3">
                                            <h5 class="text-lg mb-1">{{ __('Amount') }}</h5>
                                        </div>

                                        <div class="po-bottom-card">
                                            <h5 class="text-lg mb-1 amount">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-footer border-b-2 mb-3">
                                    <div class="flex justify-between items-center">
                                        <div class="po-bottom-card mb-3">
                                            <h5 class="text-lg mb-1">{{ __('Max Profit') }}</h5>
                                        </div>

                                        <div class="po-bottom-card">
                                            <h5 class="text-lg mb-1 max-profit">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-footer border-b-2 mb-3">
                                    <div class="flex justify-between items-center">
                                        <div class="po-bottom-card mb-3">
                                            <h5 class="text-lg mb-1">{{ __('Min Profit') }}</h5>
                                        </div>

                                        <div class="po-bottom-card">
                                            <h5 class="text-lg mb-1 min-profit">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-footer border-b-2 mb-3">
                                    <div class="flex justify-between items-center">
                                        <div class="po-bottom-card mb-3">
                                            <h5 class="text-lg mb-1">{{ __('Min Loss') }}</h5>
                                        </div>

                                        <div class="po-bottom-card">
                                            <h5 class="text-lg mb-1 min-loss">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-footer border-b-2 mb-3">
                                    <div class="flex justify-between items-center">
                                        <div class="po-bottom-card mb-3">
                                            <h5 class="text-lg mb-1">{{ __('Max Loss') }}</h5>
                                        </div>

                                        <div class="po-bottom-card">
                                            <h5 class="text-lg mb-1 max-loss">0</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-footer mb-3">
                                    <div class="flex justify-between items-center">
                                        <div class="po-bottom-card mb-3">
                                            <h5 class="text-lg mb-1">{{ __('Total') }}</h5>
                                        </div>

                                        <div class="po-bottom-card">
                                            <h5 class="text-lg mb-1 total">0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                @if(Auth::check())
                                <button type="submit" class="group  relative flex w-full justify-center rounded-md border border-transparent bg-violet-800 py-3 px-4 text-lg font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="h-5 w-5 text-violet-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    {{ __('Invest Now') }}
                                </button>
                                @else
                                <a href="{{ url('/login') }}" class="group  relative flex w-full justify-center rounded-md border border-transparent bg-violet-800 py-3 px-4 text-lg font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="h-5 w-5 text-violet-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    {{ __('Login First') }}
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <div class="cart-area rounded-lg mb-50" data-aos="zoom-in">
                        <div id="chart"></div>
                    </div>

                    <div class="map-area mt-14">
                        <div class="map-area-content mb-50">
                            <iframe src="{{ $property->meta->value['location'] ?? '' }}" width="746" height="312" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project Details Area -->
    <input type="hidden" id="id" value="{{ $property->id }}">
@endsection
@push('script')
    <script src="{{ asset('frontend/js/apex.min.js') }}"></script>
    <script src="{{ asset('frontend/js/apex-custom.js') }}"></script>
    <script src="{{ asset('frontend/js/components.js') }}"></script>
    <script>
        "use strict";
        getStatistics();
    </script>
@endpush
