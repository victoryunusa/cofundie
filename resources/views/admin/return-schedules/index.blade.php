@extends('layouts.backend.app', [
    'prev'=> route('admin.projects.index')
])

@section('title', __('Projects return schedule'))

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <form method="post" action="{{ route('admin.projects.delete') }}" class="ajaxform_with_reload"> --}}
                        <form method="post" action="#" class="ajaxform_with_reload">
                            @csrf

                            <div class="float-left mb-3">
                                <div class="input-group">
                                    <select class="form-control action" name="method">
                                        <option value="">{{ __('Select Action') }}</option>
                                        <option value="delete">{{ __('Delete Permanently') }}</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary basicbtn" type="submit">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{ route('admin.return-schedules.create', [request('project_id')]) }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('Create new') }}</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>{{ __('S/N') }}</th>
                                            <th>{{ __('Project name') }}</th>
                                            <th>{{ __('Return type') }}</th>
                                            <th>{{ __('Profit type') }}</th>
                                            <th>{{ __('Amount') }}</th>
                                            <th>{{ __('Return date') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup" name="ids[]" class="custom-control-input" value="{{ $schedule->id }}" id="data-{{ $schedule->id }}">
                                                        <label for="data-{{ $schedule->id }}" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{ $schedule->project->title ?? '' }}</td>
                                                <td>
                                                    <div class="badge badge-light">
                                                        {{ ucfirst($schedule->return_type) }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-{{ $schedule->profit_type == 'profit' ? 'success':'danger' }}">
                                                        {{ ucfirst($schedule->profit_type) }}
                                                    </div>
                                                </td>
                                                <td>{{ currency_format($schedule->amount) }}</td>
                                                <td>{{ formatted_date($schedule->return_date) }}</td>
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ __('Action') }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item has-icon" href="{{ route('admin.return-schedules.edit', [request('project_id'), $schedule->id]) }}">
                                                            <i class="far fa-edit"></i>
                                                            {{ __('Edit') }}
                                                        </a>
                                                        @if ($schedule->attachment)
                                                        <a class="dropdown-item has-icon" download href="{{ route('admin.return-schedules.show', [request('project_id'), $schedule->id]) }}">
                                                            <i class="fas fa-download"></i>
                                                            {{ __('Attachment') }}
                                                        </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                        {{ $schedules->links('admin.components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
