@extends('layouts.backend.app')

@section('title', __('Cron Jobs'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-circle"></i> {{ __('Return transactions (Profit Loss)') }} <code>({{ __('will run everyday') }})</code></h6>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="profit-loss" value=" * * * * * curl {{ route('cron.invest.profit-loss') }} >> /dev/null 2>&1" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary clipboard-button" type="button" data-clipboard-target="#profit-loss">
                            <i class="fas fa-clipboard"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-circle"></i> {{ __('Send email before installment expire in 7 days') }} <code>({{ __('will run everyday') }})</code></h6>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="before-expire-seven-days" value=" * * * * * curl {{ route('cron.before-expire-seven-day') }} >> /dev/null 2>&1" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary clipboard-button" type="button" data-clipboard-target="#before-expire-seven-days">
                            <i class="fas fa-clipboard"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script src="{{ asset('admin/plugins/clipboard-js/clipboard.min.js') }}"></script>
@endpush
