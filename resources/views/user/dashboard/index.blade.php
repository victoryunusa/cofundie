@extends('layouts.user.app')

@section('title', __('Dashboard'))

@section('content')
<div class="row">
    <div class="col-lg-4 col-sm-6">
        <div class="card card-pricing bg-gradient-default border-0 text-center mb-4">
            <div class="card-body">
                <h4 class="text-uppercase ls-1 text-white py-1 mb-0">{{ __('Account Balance') }}</h4>
                <h2 class="text-white mt-3">{{ number_format(auth()->user()->wallet, 2) }} {{ default_currency()->code }}</h2>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="font-weight-bold mb-0">{{ __('Total Deposit') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-active-40"></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 font-weight-bold">
                    <h1 class="text-nowrap total-deposit">
                        <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                    </h1>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="font-weight-bold mb-0">{{ __('Pending Deposit') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="ni ni-money-coins"></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 font-weight-bold">
                    <h1 class="text-nowrap pending-deposit">
                        <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                    </h1>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="font-weight-bold mb-0">{{ __('Total Earnings') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                          <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 font-weight-bold">
                    <h1 class="text-nowrap total-earnings">
                        <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                    </h1>
                </p>
            </div>
        </div>
    </div>

 <div class="col-lg-4 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="font-weight-bold mb-0">{{ __('Total Loss') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 font-weight-bold">
                    <h1 class="text-nowrap total-loss">
                        <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                    </h1>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="font-weight-bold mb-0">{{ __('Total Invest') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="ni ni-active-40"></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 font-weight-bold">
                    <h1 class="text-nowrap total-invest">
                        <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                    </h1>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="font-weight-bold mb-0">{{ __('Current Invest') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                          <i class="ni ni-chart-pie-35"></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 font-weight-bold">
                    <h1 class="text-nowrap current-invest">
                        <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                    </h1>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="font-weight-bold mb-0">{{ __('Total Withdraw') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                          <i class="ni ni-chart-pie-35"></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 font-weight-bold">
                    <h1 class="text-nowrap total-withdraw">
                        <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                    </h1>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6">
        <div class="card card-stats">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="font-weight-bold mb-0">{{ __('Pending Withdraw') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="ni ni-money-coins"></i>
                        </div>
                    </div>
                </div>
                <p class="mb-0 font-weight-bold">
                    <h1 class="text-nowrap pending-withdraw">
                        <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                    </h1>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-header-title">{{ __('Earnings/Loss performance') }} <img src="{{ asset('uploads/loader.gif') }}" height="20" id="earning_performance"></h4>
                <div class="card-header-action">
                    <select class="form-control" id="performance">
                        <option value="7">{{ __('Last 7 Days') }}</option>
                        <option value="15">{{ __('Last 15 Days') }}</option>
                        <option value="30">{{ __('Last 30 Days') }}</option>
                        <option value="365">{{ __('Last 365 Days') }}</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <canvas id="myChart" height="145"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header pb-0">
                <h4 class="text-primary">{{ __('Next Installments') }}</h4>
            </div>
            <div class="table-responsive pb-3">
                <table class="table table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ _('#') }}</th>
                            <th>{{ _('Plan') }}</th>
                            <th>{{ _('Amount') }}</th>
                            <th>{{ _('Duration') }}</th>
                            <th>{{ _('Next Installment') }}</th>
                            <th>{{ _('Last Payment Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($installments as $installment)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $installment->project->title }}</td>
                            <td>{{ currency_format($installment->amount) }}</td>
                            <td>{{ $installment->duration }} {{ __('Days') }}</td>
                            <td>{{ formatted_date($installment->next_installment) }}</td>
                            <td>{{ formatted_date($installment->created_at) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body pb-0">
                {{ $installments->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header pb-0">
                <h4 class="text-primary">{{ __('Next Schedule') }}</h4>
            </div>
            <div class="table-responsive pb-3">
                <table class="table table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __('S/N') }}</th>
                            <th>{{ __('Project name') }}</th>
                            <th>{{ __('Return type') }}</th>
                            <th>{{ __('Profit type') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Return date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($investments as $investment)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $investment->project->title ?? '' }}</td>
                                <td>
                                    <div class="badge badge-light">
                                        {{ ucfirst(optional($investment->project->nextschedule)->return_type) }}

                                    </div>

                                </td>
                                <td>
                                    <div class="badge badge-{{ optional($investment->project->nextschedule)->profit_type == 'profit' ? 'success':'danger' }}">
                                        {{ ucfirst(optional($investment->project->nextschedule)->profit_type) }}
                                    </div>
                                    @if(optional($investment->project->nextschedule)->attachment != null)
                                    <br>
                                    <a target="_blank" href="{{ asset(optional($investment->project->nextschedule)->attachment) }}">{{ __('Attachment') }}</a>
                                    @endif
                                </td>
                                <td>{{ currency_format(optional($investment->project->nextschedule)->amount) }}</td>
                                <td>{{ formatted_date(optional($investment->project->nextschedule)->return_date) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body pb-0">
                {{ $investments->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="get-dashbaord-url" value="{{ route('user.get-dashbaord-data') }}">
@endsection

@push('script')
    <script src="{{ asset('plugins/chatjs/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getUserDashboardData()
    </script>
@endpush
