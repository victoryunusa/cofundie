@if(isset($data['headings']['heading.the-way']))
    @php
    $heading = $data['headings']['heading.the-way'];
    @endphp
    <div class="about-us-area relative section-padding-100-50">
        <div class="container">
            <div class="grid grid-cols-12 xl:gap-12">
                <div class="col-span-12 2xl:col-span-6 sm:col-span-8">
                    <div class="about-content-text mb-50">
                        <h2 class="text-4xl sm:text-5xl xl:text-6xl capitalize mb-6 font-extrabold">{{ $heading['title'] ?? null }}</h2>
                        <h6 class="text-xl mb-10">{{ $heading['short_description'] ?? null }}</h6>
                        {!! $heading['description'] ?? null !!}

                        <div class="button-area mt-10">
                            <a class="hero-btn mr-3 mb-3 font-medium" href="{{ $heading['button1_url'] ?? null }}">{!! $heading['button1_text'] ?? null !!}</a>
                            <a class="hero-btn two mb-3" href="{{ $heading['button2_url'] ?? null }}">{!! $heading['button2_text'] ?? null !!}</a>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="col-span-12">
                    <div class="about-image-2 mb-50">
                        <img src="{{ asset($heading['image'] ?? 'frontend/img/bg-img/6.jpg') }}" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif
