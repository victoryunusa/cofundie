@if(isset($data['headings']['heading.investments-count']))
    @php
    $heading = $data['headings']['heading.investments-count'];
    @endphp
    <div class="counter-up-area bg-img section-padding-150-50" style="background-image:url({{ asset($heading['background'] ?? 'frontend/img/bg-img/5.png') }})">
        <div class="container">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-70">
                <div class="lg:text-center">
                    <h2 class="text-lg  font-semibold text-indigo-600">{{ $heading['short_title'] ?? null }}</h2>
                    <p class="mt-2 text-3xl font-bold leading-6 tracking-tight text-gray-900 sm:text-4xl">{{ $heading['title'] ?? null }}</p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">{{ $heading['description'] ?? null }}</p>
                </div>
            </div>

            <div class="grid grid-cols-12 sm:gap-8">
                <!-- Single Card -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4" data-aos="flip-left">
                    <div class="single-count-card rounded-xl bg-white p-10 py-12 text-center mb-50">
                        <h2 class="text-4xl md:text-3xl 2xl:text-4xl mb-3 uppercase text-violet-800">{{ $heading['feature_1_counter'] ?? null }}</h2>
                        <p class="text-xl sm:text-lg md:text-base 2xl:text-lg capitalize">{{ $heading['feature_1_text'] ?? null }}</p>
                    </div>
                </div>

                <!-- Single Card -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4" data-aos="flip-left">
                    <div class="single-count-card rounded-xl bg-white p-10 py-12 text-center mb-50">
                        <h2 class="text-4xl md:text-3xl 2xl:text-4xl  mb-3 uppercase text-violet-800">{{ $heading['feature_2_counter'] ?? null }}</h2>
                        <p class="text-xl sm:text-lg md:text-base 2xl:text-lg capitalize">{{ $heading['feature_2_text'] ?? null }}</p>
                    </div>
                </div>

                <!-- Single Card -->
                <div class="col-span-12 sm:col-span-6 md:col-span-4" data-aos="flip-left">
                    <div class="single-count-card rounded-xl bg-white p-10 py-12 text-center mb-50">
                        <h2 class="text-4xl md:text-3xl 2xl:text-4xl mb-3 uppercase text-violet-800">{{ $heading['feature_3_counter'] ?? null }}</h2>
                        <p class="text-xl sm:text-lg md:text-base 2xl:text-lg capitalize">{{ $heading['feature_3_text'] ?? null }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
