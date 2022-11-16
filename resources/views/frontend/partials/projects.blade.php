@if(isset($data['headings']['heading.property']))
    @php
    $heading = $data['headings']['heading.property'];
    @endphp
    <div class="feature-properties-area section-padding-100-50 bg-gray-cu">
        <div class="container">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-70">
                <div class="lg:text-center">
                    <h2 class="text-lg font-semibold text-indigo-600">{{ $heading['short_title'] ?? null }}</h2>
                    <p class="mt-2 text-3xl font-bold capitalize leading-8 tracking-tight text-gray-900 sm:text-4xl">{{ $heading['title'] ?? null }}</p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">{{ $heading['description'] ?? null }}</p>
                </div>
            </div>

            <div class="grid grid-cols-12 sm:gap-7 md:gap-8">
                <!-- Single Card -->
                @foreach ($data['projects'] as $project)
                <div class="col-span-12 sm:col-span-6 lg:col-span-4 2xl:col-span-3">
                    <div class="single-property-card rounded-b-lg mb-20">
                        <div class="property-image relative">
                            <div class="property-image-me bg-overlay" style="background-image:url({{ asset($project->thumbnail ?? 'frontend/img/bg-img/9.avif') }})">
                                <a class="absolute bottom-6 mb-2 z-99 left-2 text-white text-sm font-normal" href="{{ route('frontend.properties.show', $project->slug) }}">{{ $project->title }}</a>
                                <p class="absolute bottom-1 pb-2 left-2 text-white text-xs font-normal"><i class="fas fa-location-arrow text-xs mr-1"></i> {{ $project->address }}</p>
                            </div>

                        </div>
                        <div class="property-content-text py-6 px-4">
                            <div class="property-footer border-b-2 pt-4">
                                <div class="flex justify-between items-center">
                                    <div class="po-bottom-card mb-3">
                                        <h5 class="text-lg mb-1">{{ __('Minimum') }}</h5>
                                        <p class="text-violet-800">{{ currency_format($project->min_invest) }}</span></p>
                                    </div>

                                    <div class="po-bottom-card text-right mb-3">
                                        <h5 class="text-lg mb-1">{{ __('Maximum') }}</h5>
                                        <p class="text-violet-800">{{ currency_format($project->max_invest) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="property-footer pt-4 border-b-2 pb-3">
                                <div class="flex justify-between items-center">
                                    <div class="po-bottom-card mb-3">
                                        <h5 class="text-lg mb-1">{{ __('Profit Range') }}</h5>
                                        <p class="text-green-600">{{ $project->profit_range }} <span>({{ $project->invest_type ? '%':'Fixed' }})</span></p>
                                    </div>

                                    <div class="po-bottom-card mb-3 text-right">
                                        <h5 class="text-lg mb-1">{{ __('Loss Range') }}</h5>
                                        <p class="text-red-600">{{ $project->loss_range }} <span>({{ $project->invest_type ? '%':'Fixed' }})</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="property-footer pt-4 pb-3">
                                <div class="flex justify-between items-center">
                                    <div class="po-bottom-card">
                                        <h5 class="text-lg mb-1">{{ __('Return For') }}</h5>
                                        <p class="text-red-600">{{ $project->is_period ? ucfirst($project->period_duration) : "Lifetime" }}</span></p>
                                    </div>

                                    <div class="po-bottom-card text-right">
                                        <h5 class="text-lg mb-1">{{ __('Capital Back') }}</h5>
                                        <p class="text-green-600">{{ $project->capital_back ? 'Yes':'No' }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
