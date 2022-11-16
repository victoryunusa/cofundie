@extends('layouts.user.app')

@section('title', __('Investments'))

@section('content')
<div class="card card-primary search-table">
    <div class="table-responsive py-3">
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
@endsection
