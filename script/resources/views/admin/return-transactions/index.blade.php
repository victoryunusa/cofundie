@extends('layouts.backend.app')

@section('title', __('Return Transactions'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ __('Return Transactions') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-flush table-bordered" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ _('#') }}</th>
                                <th>{{ _('Email') }}</th>
                                <th>{{ _('User') }}</th>
                                <th>{{ _('Plan') }}</th>
                                <th>{{ _('Amount') }}</th>
                                <th>{{ _('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($returns as $return)
                            <tr>
                                <td>{{ $loop->index+1 }}</th>
                                <td>{{ $return->user->name }}</th>
                                <td>{{ $return->user->email }}</th>
                                <td>{{ $return->project->title }}</th>
                                <td>{{ $return->amount }}</th>
                                <td>{{ formatted_date($return->created_at) }}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $returns->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
