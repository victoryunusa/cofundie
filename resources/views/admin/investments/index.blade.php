@extends('layouts.backend.app')

@section('title', __('Investments List'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Investments List') }}</h4>
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
                    {{ $investments->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
