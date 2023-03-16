@if(isset($data['headings']['heading.smart-investors']))
    @php
    $heading = $data['headings']['heading.smart-investors'];
    @endphp
    <!-- About Us Area -->
    <div class="about-us-area section-padding-100-50">
        <div class="container">
            <div class="grid grid-cols-12 lg:gap-12">
                <!-- Image -->
                <div class="col-span-12 lg:col-span-6">
                    <div class="about-image float-bob-y mb-50">
                        <img src="{{ asset($heading['image'] ?? 'frontend/img/bg-img/4.png') }}" alt="">
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="about-content-text mb-50">
                        <h2 class="text-4xl sm:text-5xl 2xl:text-6xl capitalize mb-6 font-extrabold">{{ $heading['title'] ?? null }}</h2>
                        {!! $heading['description'] ?? null !!}
                        <h6 class="text-violet-800 text-xl lg:text-lg">{!! $heading['suggestions'] ?? null !!}</h6>
                        <a class="hero-btn mt-10 font-medium" href="{{ $heading['btn_link'] ?? null }}">{{ $heading['btn_text'] ?? null }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Area -->
@endif
