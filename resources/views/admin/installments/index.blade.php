@extends('layouts.backend.app')

@section('title', __('Installments List'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Installments list') }}</h4>
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
                    {{ $installments->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
