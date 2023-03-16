@extends('layouts.backend.app')

@section('title', __('Dashboard'))

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Customers') }}</h4>
                        </div>
                        <div class="card-body total_customers">
                            <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Investments') }}</h4>
                        </div>
                        <div class="card-body total_investments">
                            <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Investment Amount') }}</h4>
                        </div>
                        <div class="card-body investments_amount">
                            <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Plans') }}</h4>
                        </div>
                        <div class="card-body total_plans">
                            <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-dark">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Active Plans') }}</h4>
                        </div>
                        <div class="card-body active_plans">
                            <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Deactive Plans') }}</h4>
                        </div>
                        <div class="card-body deactiev_plans">
                            <img src="{{ asset('frontend/img/icons/loader.gif') }}" height="20">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Installments') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ _('#') }}</th>
                                <th>{{ _('Plan') }}</th>
                                <th>{{ _('User') }}</th>
                                <th>{{ _('Amount') }}</th>
                                <th>{{ _('Is Late') }}</th>
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
                                <td>{{ $installment->user->name }}</td>
                                <td>{{ $installment->amount }}</td>
                                <td class="text-{{ $installment->is_late ? 'danger':'success' }}">{{ $installment->is_late ? 'Yes':'No' }}</td>
                                <td>{{ $installment->duration }} {{ __('Days') }}</td>
                                <td>{{ formatted_date($installment->next_installment) }}</td>
                                <td>{{ formatted_date($installment->created_at) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('New Investment') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ _('#') }}</th>
                                <th>{{ _('Trx') }}</th>
                                <th>{{ _('Plan') }}</th>
                                <th>{{ _('User') }}</th>
                                <th>{{ _('Amount') }}</th>
                                <th>{{ _('Total Share') }}</th>
                                <th>{{ _('Is returnable') }}</th>
                                <th>{{ _('Return start from') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($investments as $investment)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $investment->trx }}</td>
                                <td>{{ $investment->project->title }}</td>
                                <td>{{ $investment->user->name }}</td>
                                <td>{{ $investment->amount }}</td>
                                <td>{{ $investment->share.'%' }}</td>
                                <td>{{ $investment->is_returnable ? 'Yes':'No' }}</td>
                                <td>{{ formatted_date($investment->created_at) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Pending Support') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ _('#') }}</th>
                                <th>{{ _('User') }}</th>
                                <th>{{ _('Email') }}</th>
                                <th>{{ _('Ticket no') }}</th>
                                <th>{{ _('Subject') }}</th>
                                <th>{{ _('Reference code') }}</th>
                                <th>{{ _('Details') }}</th>
                                <th>{{ _('Send At') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supports as $support)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $support->user->name }}</td>
                                <td>{{ $support->user->email }}</td>
                                <td>{{ $support->ticket_no }}</td>
                                <td>{{ $support->subject }}</td>
                                <td>{{ $support->reference_code }}</td>
                                <td>{{ Str::limit($support->details, 50, '...') }}</td>
                                <td>{{ formatted_date($support->created_at) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Pending deposits') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>{{ __('S/N') }}</th>
                                <th>{{ __('Trx ID') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Charge') }}</th>
                                <th>{{ __('Payment Method') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposits as $deposit)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $deposit->trx }}</td>
                                <td>{{ currency_format($deposit->amount) }}</td>
                                <td>{{ formatted_date($deposit->created_at) }}</td>
                                <td>{{ number_format($deposit->charge, 2) }}</td>
                                <td>{{ $deposit->gateway->name }}</td>
                                <td>
                                    @if ($deposit->status == 2)
                                    <span class="badge badge-warning">
                                        {{ __('Pending') }}
                                    </span>
                                    @elseif ($deposit->status == 1)
                                    <span class="badge badge-success">
                                        {{ __('Completed') }}
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        {{ __('Rejected') }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Pending withdrawal') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('Method') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Charge') }}</th>
                                <th>{{ __('After Charge') }}</th>
                                <th>{{ __('Currency') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdraws as $withdraw)
                                <tr id="row4">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ optional($withdraw->method)->name }}</td>
                                    <td>{{ date('d M y', strtotime($withdraw->created_at)) }}</td>
                                    <td>{{ currency_format($withdraw->amount) }}</td>
                                    <td>{{ currency_format($withdraw->charge) }}</td>
                                    <td>{{ currency_format($withdraw->amount - $withdraw->charge) }}</td>
                                    <td>{{ $withdraw->currency->name ?? '' }}</td>
                                    <td>
                                        @if ($withdraw->status == 'pending')
                                            <span class="badge badge-warning">{{ __('Pending') }}</span>
                                        @elseif ($withdraw->status == 'rejected')
                                            <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                        @elseif ($withdraw->status == 'approved')
                                            <span class="badge badge-success">{{ __('Approved') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="get-dashbaord-url" value="{{ route('admin.get-dashbaord-data') }}">
    <input type="hidden" id="performance" value="{{ route('admin.dashboard.performance',7) }}">
    <input type="hidden" id="visitors" value="{{ route('admin.dashboard.visitors',7) }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getAdminDashboardData()
    </script>
@endpush
