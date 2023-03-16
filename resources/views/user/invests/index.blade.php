@extends('layouts.user.app')

@section('title', __('Investments'))

@section('content')
<div class="card card-primary search-table">
    <div class="card-header pb-2">
        <h4></h4>
        <form action="#" class="card-header-form">
            @csrf
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Plan Name") }}">
                <div class="input-group-btn">
                    <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive pb-5">
        <table class="table table-flush">
            <thead class="thead-light">
                <tr>
                    <th>{{ __('S/N') }}</th>
                    <th>{{ __('Plan Name') }}</th>
                    <th>{{ __('Gateway') }}</th>
                    <th>{{ __('Invest Amount') }}</th>
                    <th>{{ __('Invest Date') }}</th>
                    <th>{{ __('Next Payment Date') }}</th>
                    <th>{{ __('Payment Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invests as $invest)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a href="{{ url('/properties/'.$invest->project->slug ?? '') }}" target="_blank">{{ $invest->project->title ?? '' }}</a></td>
                        <td>{{ $invest->gateway->name ?? $invest->gateway_id }}</td>
                        <td>{{ currency_format($invest->amount) }}</td>
                        <td>{{ formatted_date($invest->created_at) }}</td>
                        <td>{{ formatted_date(optional($invest->project->nextschedule)->return_date) }}</td>
                        <td>
                            <div class="badge badge-{{ $invest->payment_status ? 'success':'danger' }}">
                                {{ $invest->payment_status ? 'Success':'Pending' }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body pb-0">
        {{ $invests->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
