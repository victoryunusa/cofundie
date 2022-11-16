@extends('layouts.user.app')

@section('title', __('Transactions'))

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 total-transactions">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Total Transactions') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 credit-transactions">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Credit Transactions') }}</h5>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h2 font-weight-bold mb-0 debit-transactions">
                                <img src="https://foodsify.xyz/uploads/loader.gif" height="20" id="loading">
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Debit Transactions') }}</h5>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header pb-0">
            <h4>{{ __("Transactions") }}</h4>
            <form class="card-header-form">
                <div class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Search...") }}">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive py-3">
                <table class="table table-flush" id="subscriber-table">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __("S/N") }}</th>
                            <th>{{ __("From") }}</th>
                            <th>{{ __("Amount") }}</th>
                            <th>{{ __("Charge") }}</th>
                            <th>{{ __("Type") }}</th>
                            <th>{{ __("Reason") }}</th>
                            <th>{{ __("Created") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                {{ $transaction->name }}<br>
                                {{ $transaction->email }}
                            </td>
                            <td>{{ currency_format($transaction->amount, currency: $transaction->currency) }}</td>
                            <td>{{ currency_format($transaction->charge, currency: $transaction->currency) }}</td>
                            <td>
                                @if($transaction->type == 'credit')
                                    <span class="badge badge-success"><i class="fas fa-arrow-circle-down"></i> {{ __("Credit") }}</span>
                                @else
                                    <span class="badge badge-danger"><i class="fas fa-arrow-circle-up"></i> {{ __("Debit") }}</span>
                                @endif
                            </td>
                            <td>{!! wordwrap($transaction->reason, 50, "<br />\n") !!}</td>
                            <td>{{ formatted_date($transaction->created_at) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $transactions->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
    <input type="hidden" id="get-transaction-url" value="{{ route('user.get-transaction') }}">
@endsection

@push('script')
    <script src="{{ asset('admin/js/admin.js') }}"></script>
    <script>
        "use strict";
        getTotalTransactions()
    </script>
@endpush
