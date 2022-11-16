@if(isset($data['headings']['heading.income-history']))
    @php
    $heading = $data['headings']['heading.income-history'];
    @endphp

    <div class="income-chart-area section-padding-100-50">
        <div class="container">
            <div class="grid grid-cols-12 lg:gap-10">
                <div class="col-span-12 lg:col-span-6">
                    <div class="income-content-text mb-50">
                        <h6 class="text-xl uppercase mb-3 text-violet-800">{{ $heading['short_title'] ?? null }}</h6>
                        <h2 class="text-4xl sm:text-5xl 2xl:text-6xl capitalize font-extrabold mb-6">{{ $heading['title'] ?? null }}</h2>
                        {!! $heading['description'] ?? null !!}
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-6">
                    <div class="about-image float-bob-y mb-50">
                        <img src="{{ asset($heading['image'] ?? 'frontend/img/bg-img/chart.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
