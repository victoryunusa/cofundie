@if(isset($data['headings']['heading.welcome']))
    @php
    $heading = $data['headings']['heading.welcome'];
    @endphp

    <section class="welcome-area">
        <div class="welcome-bg-shape">
            <img src="{{ asset($heading['background_image_1'] ?? null) }}" alt="">
        </div>
        <div class="welcome-bg-shape-2">
            <img src="{{ asset($heading['background_image_2'] ?? null) }}" alt="">
        </div>

        <!-- Content text -->
        <div class="welcome-content-text h-100 flex items-center">
            <div class="container ">
                <div class="grid sm:grid-cols-12 grid-cols-1 gap-12 items-center">
                    <!-- Welcome Text -->
                    <div class="welcome-text col-span-7">
                        <h2 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black mb-4">{{ $heading['title'] ?? null }}</h2>
                        <p class="text-neutral-900 text-base  2xl:text-xl mb-9">{{ $heading['description'] ?? null }}</p>
                        <div class="button-area">
                            <a class="hero-btn mr-3 mb-3 font-medium" href="{{ $heading['button1_url'] ?? null }}" data-aos="zoom-in" data-aos-duration="600">{{ $heading['button1_text'] ?? null }}</a>
                            <a class="hero-btn two mb-3" href="{{ $heading['button2_url'] ?? null }}" data-aos="zoom-in" data-aos-duration="1000">{{ $heading['button2_text'] ?? null }}</a>
                        </div>
                    </div>

                    <!-- Welcome Image -->
                    <div class="col-span-5">
                        <div class="welcome-image text-center">
                            <img src="{{ asset($heading['image'] ?? null) }}" alt="">

                            <div class="welcome-image-2 float-bob-y"><img src="{{ asset($heading['animate_image'] ?? null) }}" alt=""></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
