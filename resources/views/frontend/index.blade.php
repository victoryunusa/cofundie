@extends('layouts.frontend.app')

@section('seo')
    {!! SEOMeta::generate() !!}
    {!! Twitter::generate() !!}
@endsection

@section('content')
    <!-- Welcome Area Start -->
    @include('frontend.partials.welcome')
    <!-- Feature Area -->
    @include('frontend.partials.feature')
    <!-- Feature Area -->
    @include('frontend.partials.about')

    <!-- Counter Up Area -->
    @include('frontend.partials.investor-count')
    <!-- Counter Up Area -->

    <!-- About Us Area -->
    @include('frontend.partials.changing-way')
    <!-- About Us Area -->

    <!-- Featured properties -->
    @include('frontend.partials.projects')
    <!-- Featured properties -->

    <!-- Income Chart -->
    @include('frontend.partials.income-history')
    <!-- Income Chart -->

    <!-- Blog Area -->
    @include('frontend.partials.blogs')
    <!-- Blog Area -->
@endsection
