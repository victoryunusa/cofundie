@if(isset($data['headings']['heading.feature']))
    @php
    $heading = $data['headings']['heading.feature'];
    @endphp
    <div class="feature-area relative section-padding-100-50 bg-gray-cu">
        <div class="container">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-70">
                <div class="lg:text-center">
                    <h2 class="text-lg font-semibold text-indigo-600">{{ $heading['short_title'] ?? null }}</h2>
                    <p class="mt-2 text-3xl font-bold leading-8 tracking-tight text-gray-900 sm:text-4xl">{{ $heading['title'] ?? null }}</p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">{{ $heading['description'] ?? null }}</p>
                </div>
            </div>

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
