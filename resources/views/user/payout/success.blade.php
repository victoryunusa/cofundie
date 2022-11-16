@extends('layouts.user.app')

@section('title', __('Payout Methods'))

@section('content')
    <div class="row justify-content-center">
        @if (session('success_msg'))
            <div class="col-8">
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        <strong>{{ __('Success!') }}</strong> {{ session('success_msg') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="col-sm-10 search-table">
            <div class="card radius-card">
                <div class="card-header">
                    <h3 class="text-primary">
                        <a class="btn btn-primary btn-sm rounded-pill" href="{{ route('user.payout.index') }}"><i class="fa fa-backward" aria-hidden="true"></i> {{ __('Back') }}</a>
                        {{ __('An OTP has been sended to your mail. Please check and confirm.') }}
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.payout.success', request('method_id')) }}" method="post" class="ajaxform_instant_reload mb-5">
                        @csrf
                        <div class="input-group">
                            <input type="number" name="otp" class="form-control" placeholder="{{ __('OTP') }}" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon submit-btn">{{ __('Confirm') }} <i class="fas fa-forward"></i></button>
                            </div>
                        </div>
                    </form>
                    @php
                        $payout_amount = session('payout_amount');
                        $method_charge = session('method_charge');
                        $plan_charge = session('plan_charge');
                        $total_charge = $method_charge + $plan_charge;
                        $available_amount = $payout_amount - $total_charge;
                    @endphp
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Your current balance is') }}</h4>
                        <h4 class="font-weight-bold">{{ currency_format(auth()->user()->wallet) }}</h4>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Your payout request amount') }}</h4>
                        <h4 class="font-weight-bold">{{ currency_format($payout_amount) }}</h4>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Payout method charge') }}</h4>
                        <h4 class="font-weight-bold">{{ currency_format($method_charge) }}</h4>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Plan payout charge') }}</h4>
                        <h4 class="font-weight-bold">{{ currency_format($plan_charge) }}</h4>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Total charge') }}</h4>
                        <h4 class="font-weight-bold">{{ currency_format($total_charge) }}</h4>
                    </div>
                    <div class="d-flex justify-content-between p-1">
                        <h4>{{ __('Avalilable amount') }}</h4>
                        <h4 class="font-weight-bold">{{ currency_format($available_amount) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
