@extends('layouts.backend.app')

@section('title', __('Headings'))

@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="welcome-tab" data-toggle="tab" href="#welcome" role="tab" aria-controls="home" aria-selected="true">
                                {{ __('Welcome Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="explore-tab" data-toggle="tab" href="#explore" role="tab" aria-controls="explore" aria-selected="false">
                                {{ __('Explore By Cities Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="smart-investors-tab" data-toggle="tab" href="#smart-investors" role="tab" aria-controls="smart-investors" aria-selected="false">
                                {{ __('Smart Investors Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="count-all-investments-tab" data-toggle="tab" href="#count-all-investments" role="tab" aria-controls="count-all-investments" aria-selected="false">
                                {{ __('Count All Investments Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="the-way-tab" data-toggle="tab" href="#the-way" role="tab" aria-controls="home" aria-selected="true">
                                {{ __("We're Changing The Way Section") }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="income-history-tab" data-toggle="tab" href="#income-history" role="tab" aria-controls="home" aria-selected="true">
                                {{ __("Income History Section") }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="latest-news-tab" data-toggle="tab" href="#latest-news" role="tab" aria-controls="latest-news" aria-selected="false">
                                {{ __('Latest News & Blog Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="false">
                                {{ __('About Us Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="property-tab" data-toggle="tab" href="#property" role="tab" aria-controls="property" aria-selected="false">
                                {{ __('Property Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="how-works-tab" data-toggle="tab" href="#how-works" role="tab" aria-controls="how-works" aria-selected="false">
                                {{ __('How It Works Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="our-assets-tab" data-toggle="tab" href="#our-assets" role="tab" aria-controls="our-assets" aria-selected="false">
                                {{ __('Your Returns Are Maximized Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="your-portfolio-tab" data-toggle="tab" href="#your-portfolio" role="tab" aria-controls="your-portfolio" aria-selected="false">
                                {{ __('Your Portfolio Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="faq-tab" data-toggle="tab" href="#faq" role="tab" aria-controls="faq" aria-selected="false">
                                {{ __('Faq Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="faq-questions-tab" data-toggle="tab" href="#faq-questions" role="tab" aria-controls="faq-questions" aria-selected="false">
                                {{ __('Faq Questions Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="faq-privacy" data-toggle="tab" href="#privacy" role="tab" aria-controls="privacy" aria-selected="false">
                                {{ __('Privacy & Policy') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="faq-terms" data-toggle="tab" href="#terms" role="tab" aria-controls="terms" aria-selected="false">
                                {{ __('Terms & Condition') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="faq-investments" data-toggle="tab" href="#investments" role="tab" aria-controls="investments" aria-selected="false">
                                {{ __('Investment Section') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="false">
                                {{ __('Contact Us') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-8">
            <div class="tab-content no-padding" id="myTab2Content">
                <div class="tab-pane fade show active" id="welcome" role="tabpanel" aria-labelledby="welcome-tab">
                    @include('admin.settings.website.heading.welcome')
                </div>

                <div class="tab-pane fade" id="explore" role="tabpanel" aria-labelledby="explore-tab">
                    @include('admin.settings.website.heading.explore-cities')
                </div>

                <div class="tab-pane fade" id="smart-investors" role="tabpanel" aria-labelledby="smart-investors-tab">
                    @include('admin.settings.website.heading.smart-investors')
                </div>

                <div class="tab-pane fade" id="count-all-investments" role="tabpanel" aria-labelledby="count-all-investments-tab">
                    @include('admin.settings.website.heading.count-all-investments')
                </div>

                <div class="tab-pane fade" id="the-way" role="tabpanel" aria-labelledby="the-way-tab">
                    @include('admin.settings.website.heading.the-way')
                </div>

                <div class="tab-pane fade" id="income-history" role="tabpanel" aria-labelledby="income-history-tab">
                    @include('admin.settings.website.heading.income-history')
                </div>

                <div class="tab-pane fade" id="latest-news" role="tabpanel" aria-labelledby="latest-news-tab">
                    @include('admin.settings.website.heading.latest-news')
                </div>

                <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                    @include('admin.settings.website.heading.about')
                </div>

                <div class="tab-pane fade" id="property" role="tabpanel" aria-labelledby="property-tab">
                    @include('admin.settings.website.heading.property')
                </div>

                <div class="tab-pane fade" id="how-works" role="tabpanel" aria-labelledby="how-works-tab">
                    @include('admin.settings.website.heading.how-works')
                </div>

                <div class="tab-pane fade" id="our-assets" role="tabpanel" aria-labelledby="our-assets-tab">
                    @include('admin.settings.website.heading.our-assets')
                </div>

                <div class="tab-pane fade" id="your-portfolio" role="tabpanel" aria-labelledby="your-portfolio-tab">
                    @include('admin.settings.website.heading.your-portfolio')
                </div>

                <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    @include('admin.settings.website.heading.faq')
                </div>

                <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    @include('admin.settings.website.heading.faq')
                </div>

                <div class="tab-pane fade" id="faq-questions" role="tabpanel" aria-labelledby="faq-questions-tab">
                    @include('admin.settings.website.heading.faq-questions')
                </div>

                <div class="tab-pane fade" id="privacy" role="tabpanel" aria-labelledby="privacy">
                    @include('admin.settings.website.heading.privacy')
                </div>

                <div class="tab-pane fade" id="terms" role="tabpanel" aria-labelledby="terms">
                    @include('admin.settings.website.heading.terms')
                </div>

                <div class="tab-pane fade" id="investments" role="tabpanel" aria-labelledby="investments">
                    @include('admin.settings.website.heading.investments')
                </div>

                <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                    @include('admin.settings.website.heading.contacts')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    {{ mediasingle() }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
@endpush

@push('script')
    <script src="{{ asset('plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js') }}"></script>
@endpush
