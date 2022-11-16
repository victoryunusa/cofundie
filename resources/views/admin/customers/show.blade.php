@extends('layouts.backend.app', [
    'prev' => route('admin.customers.index')
])

@section('title', __('Customer Profile'))

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card bg-gradient-danger border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                        <img src="{{ avatar() }}" alt="" class="rounded-circle" width="50">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <h3 class="mt-3 mx-auto text-white">{{ $customer->name }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group mt-4">
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Account ID') }}</div>
                            <div class="font-weight-light">{{ $customer->id }}</div>
                        </li>

                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Username') }}</div>
                            <div class="font-weight-light"><span>@</span>{{ $customer->username }}</div>
                        </li>
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Email') }}</div>
                            <div class="font-weight-light">
                                {{ $customer->email }}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Wallet') }}</div>
                            <div class="font-weight-light">
                                {{ currency_format($customer->wallet) }}
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Account Status') }}</div>
                            <div class="font-weight-light">
                                @if($customer->status == 1)
                                    <span class="badge badge-primary">{{ __('Active') }}</span>
                                @elseif($customer->status == 0)
                                    <span class="badge badge-warning">{{ __('Inactive') }}</span>
                                @elseif($customer->status == 2)
                                    <span class="badge badge-danger">{{ __('Banned') }}</span>
                                @endif
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Email Verified At') }}</div>
                            <div class="font-weight-light">
                                {{ formatted_date($customer->email_verified_at) }}
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="font-weight-bolder">{{ __('Kyc Verified At') }}</div>
                            <div class="font-weight-light">
                                @if($customer->kyc_verified_at)
                                    {{ formatted_date($customer->email_verified_at) }}
                                @else
                                    {{ __('Not verified') }}
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Deposit') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency_format($customer->deposits_sum_amount, currency: $customer->currency) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-info">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Withdraw') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ 55 }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-money-bill-wave-alt"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>{{ __('Total Transaction') }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ currency_format($customer->transactions_sum_amount, currency: $customer->currency) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('script')
    <script src="{{ asset('admin/plugins/summernote/summernote.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.js') }}"></script>
@endpush
