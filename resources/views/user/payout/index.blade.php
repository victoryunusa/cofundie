@extends('layouts.user.app')

@section('title', __('Payout Methods'))

@section('content')
    <div class="row justify-content-center">
        @if (session('success_msg'))
            <div class="col-8">
                <div class="alert alert-warning alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        {{ session('success_msg') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="col-sm-12">
            <div class="card custom-border card-primary">
                <div class="card-header">
                    <h2 class="text-primary">{{ __('Your balance') }}</h2>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Available to pay out to you') }}</h4>
                        <h4 class="font-weight-bold">{{ currency_format(auth()->user()->wallet) }}</h4>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Currently on the way to your bank account') }}</h4>
                        <h4 class="font-weight-bold">{{ currency_format($pending_amount) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($methods as $method)
        <div class="col-sm-6">
            <div class="card custom-border">
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between p-1">
                            <h3 class="section-title font-weight-bold">{{ __('Receive payments directly with '.$method->name) }}</h3>
                            @if ($method->usermethod)
                            <h3> {{ $method->currency->name ?? '' }} </h3>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <h5>{{ $method->usermethod ? __('Account connected'):__('Account not connected') }}</h5>
                        </div>
                        @if ($method->usermethod)
                        <div class="col-4 text-right">
                            <a class="white-custom-btn" href="{{ route('user.payout.edit', $method->id) }}"><i class="fas fa-edit"></i></a>
                        </div>
                        @endif
                    </div>
                    @if ($method->data && $method->usermethod && optional($method->usermethod)->payout_infos == null)
                        <a class="btn btn-warning btn-lg rounded btn-sm mt-2" href="{{ route('user.payout.edit', $method->id) }}">
                            {{ __('Please edit with your credintials') }}
                        </a>
                    @elseif ($method->usermethod)
                        <a class="btn btn-primary btn-lg rounded btn-sm mt-2" href="{{ route('user.payout.make-payout', $method->id) }}">
                            {{ __('Make payout') }}
                        </a>
                    @endif
                    @if (!$method->usermethod)
                        <a class="btn btn-primary btn-lg rounded btn-sm mt-2" href="{{ route('user.payout.setup', $method->id) }}">
                            {{ __('Set up') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@push('css')
    <style>
        .custom-border {
            border-radius: 1.5rem !important;
        }
    </style>
@endpush
