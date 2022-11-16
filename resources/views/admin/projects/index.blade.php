@extends('layouts.backend.app', ['title' => __('Projects Plan')])

@section('title', __('Projects Plan'))

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.projects.delete-all') }}" class="confirm-form">
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
                                <a class="btn btn-primary" href="{{ route('admin.projects.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> {{ __('Create new') }}</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table" id="table-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center pt-2">
                                                <div class="custom-checkbox custom-checkbox-table custom-control">
                                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input checkAll" id="checkbox-all">
                                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th>{{ __('S/N') }}</th>
                                            <th>{{ __('Thumbnail') }}</th>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Min invest') }}</th>
                                            <th>{{ __('Max invest') }}</th>
                                            <th>{{ __('Max invest Amount') }}</th>
                                            <th>{{ __('Is period') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projects as $project)
                                            <tr>
                                                <td class="text-center">
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup" name="ids[]" class="custom-control-input" value="{{ $project->id }}" id="data-{{ $project->id }}">
                                                        <label for="data-{{ $project->id }}" class="custom-control-label">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td><img height="40" src="{{ $project->thumbnail }}" alt=""></td>
                                                <td>{{ $project->title }}</td>
                                                <td>{{ $project->min_invest }}</td>
                                                <td>{{ $project->max_invest }}</td>
                                                <td>{{ $project->max_invest_amount }}</td>
                                                <td>
                                                    <div class="badge badge-{{ $project->is_period ? 'success':'warning' }}">
                                                        {{ $project->is_period ? 'Yes':'No' }}
                                                    </div>
                                                </td>
                                                <td>{{ formatted_date($project->created_at) }}</td>
                                                <td>
                                                    <div class="badge badge-{{ $project->status ? 'success':'danger' }}">
                                                        {{ $project->status ? 'Active':'Deactive' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ __('Action') }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item has-icon" href="{{ route('admin.projects.show', $project->id) }}">
                                                            <i class="far fa-eye"></i>
                                                            {{ __('View') }}
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="{{ route('admin.projects.edit', $project->id) }}">
                                                            <i class="far fa-edit"></i>
                                                            {{ __('Edit') }}
                                                        </a>
                                                        <a class="dropdown-item has-icon" href="{{ route('admin.return-schedules.index', $project->id) }}">
                                                            <i class="fas fa-undo"></i>
                                                            {{ __('Return Schedule') }}
                                                        </a>
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
                        {{ $projects->links('admin.components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
