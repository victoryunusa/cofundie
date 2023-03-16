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
                            <a href="{{ route('frontend.properties.show', $project->slug) }}"> <img class="rounded-t-lg relative" src="{{ asset($project->thumbnail ?? 'frontend/img/bg-img/9.avif') }}" alt=""></a>
                            {{-- <a class="absolute bottom-1 z-10 left-1 text-white text-sm font-normal" href="{{ route('frontend.properties.show', $project->slug) }}">{{ $project->title }}</a> --}}
                        </div>
                        <div class="property-content-text py-6 px-4">
                            <h4 class="text-2xl mb-2 text-violet-800">{{ currency_format($project->min_invest) }}</h4>
                            <p class="text-sm text-gray-500">
                                @foreach ($project->meta->value['icon'] ?? '' as $key => $icon)
                                <span class="border-r-2 pr-2 border-t-zinc-700 border-spacing-7"><i class="{{ $icon }}"></i> {{ $project->meta->value['item'][$key] }}</span>
                                @endforeach
                            <div class="pro-tag-area mt-3 border-b-2 border-gray-200 pb-4">
                                <a class="text-sm font-bold text-violet-800 mr-2" href="{{ url('user/invests/plans') }}">Invest Today</a>
                                <a class="text-sm font-bold text-green-600 mr-2" href="{{ url('user/invests/plans') }}">Invest Using Balence</a>
                                <a class="text-sm font-bold text-red-600" href="{{ url('/contact') }}">Contact Us</a>
                            </div>

                            <div class="property-footer pt-4">
                                <div class="flex justify-between items-center">
                                    <div class="po-bottom-card">
                                        <h5 class="text-lg mb-1">{{ $project->profit_range }}<span>{{ $project->invest_type ? '%':' (Fixed)' }}</span></h5>
                                        <p class="text-xs uppercase">{{ __('Profit Range') }}</p>
                                    </div>

                                    <div class="po-bottom-card">
                                        <h5 class="text-lg mb-1 text-violet-800">{{ $project->is_period ? ucfirst($project->period_duration) : "Lifetime" }}</h5>
                                        <p class="text-xs uppercase">{{ __('Return For') }}</p>
                                    </div>
                                    <div class="po-bottom-card">
                                        <h5 class="text-lg mb-1 text-orange-400">{{ $project->capital_back ? 'Yes':'No' }}</h5>
                                        <p class="text-xs uppercase">{{ __('Capital Back') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @isset($projects)
            {{ $projects->links('vendor.pagination.tailwind') }}
            @endisset
        </div>

    </div>
@endif
