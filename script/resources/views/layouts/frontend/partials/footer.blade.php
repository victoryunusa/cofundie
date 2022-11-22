@php
    $logo = get_option('logo_setting');
    $footer = get_option('footer_setting');
@endphp

<!-- Footer Area -->
<div class="footer-area bg-slate-800 section-padding-100-50">
    <div class="welcome-bg-shape-2">
        <img src="{{ asset($footer->footer_left ?? 'frontend/img/icons/5.png') }}" alt="">
    </div>
    <div class="welcome-bg-shape-3">
        <img src="{{ asset($footer->footer_right ?? 'frontend/img/icons/5.png') }}" alt="">
    </div>
    <div class="container">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-4 md:col-span-12 sm:col-span-6 pb-50">
                <a href="#" class="footer-logo">
                    <img class="w-36" src="{{ asset($logo['logo'] ?? 'frontend/img/core-img/logo.png') }}" alt="">
                </a>
                <p class="mt-6 text-gray-300 font-normal">{{ $footer['about'] ?? null }}</p>
                <ul class="footer-social-icon mt-6">
                    @foreach($footer['social'] ?? [] as $social)
                        <li class="inline"><a href="{{ $social['website_url'] ?? null }}"><i @class([$social['icon_class'] ?? null])></i></a></li>
                    @endforeach
                </ul>
                <!--end icon-->
               
            </div>
            <!--end col-->

            <div class="col-span-12 lg:col-span-2 md:col-span-4 sm:col-span-6 pb-50">
                <h5 class="tracking-[1px] text-gray-100 font-normal">{{ __('Company') }}</h5>
                <ul class="list-none footer-list mt-6">
                    {{ RenderMenu('footer_left_menu', 'components.menu.footer') }}
                </ul>
            </div>
            <!--end col-->

            <div class="col-span-12 lg:col-span-2 md:col-span-4 sm:col-span-6 pb-50">
                <h5 class="tracking-[1px] text-gray-100 font-normal">{{ __('Usefull Links') }}</h5>
                <ul class="list-none footer-list mt-6">
                    {{ RenderMenu('footer_right_menu', 'components.menu.footer') }}
                </ul>
            </div>
            <!--end col-->

            <div class="col-span-12 lg:col-span-4 md:col-span-4 sm:col-span-6 pb-50">
                <h5 class="tracking-[1px] text-white font-normal mb-4">{{ __('Newsletter') }}</h5>
                <form action="{{ route('frontend.subscribe-to-news-letter') }}" method="post" class="ajaxform">
                    @csrf

                    <div class="grid grid-cols-1">
                        <div class="foot-subscribe my-3">
                            <label class="form-label text-white">{{ __('Write your email') }} <span class="text-red-600">*</span></label>
                            <div class="form-icon relative mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-mail w-4 h-4 absolute top-3 left-4">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>

                                <!-- Form -->
                                <input type="email" class="form-input footer" placeholder="Email" name="email" required="">
                            </div>
                        </div>

                        <button type="submit" class="btn submit-btn">{{ __('Subscribe') }}</button>
                    </div>
                </form>
            </div>
            <!--end col-->
        </div>
    </div>
</div>
<!-- Footer Area -->
