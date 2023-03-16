@extends('layouts.backend.app', [
    'prev'=> route('admin.projects.index')
])

@section('title', __('Projects Plan'))

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <tr>
                                    <th>{{ __('Thumbnail') }}</th>
                                    <th><img height="40" src="{{ $project->thumbnail }}" alt=""></th>
                                    <th>{{ __('Preview') }}</th>
                                    <th><img height="40" src="{{ $project->preview }}" alt=""></th>
                                    <th>{{ __('Title') }}</th>
                                    <td>{{ $project->title }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Invest Type') }}</th>
                                    <td>
                                        <div class="badge badge-{{ $project->invest_type ? 'success':'warning' }}">
                                            {{ $project->invest_type ? 'Percantage':'Fixed' }}
                                        </div>
                                    </td>
                                    <th>{{ __('Capital Back') }}</th>
                                    <td>
                                        <div class="badge badge-{{ $project->capital_back ? 'success':'warning' }}">
                                            {{ $project->capital_back ? 'Yes':'No' }}
                                        </div>
                                    </td>
                                    <th>{{ __('Status') }}</th>
                                    <td>
                                        <div class="badge badge-{{ $project->status ? 'success':'warning' }}">
                                            {{ $project->status ? 'Active':'Deactive' }}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Profit Range') }}</th>
                                    <td>{{ $project->profit_range }}</td>
                                    <th>{{ __('Profit Loss') }}</th>
                                    <td>{{ $project->loss_range }}</td>
                                    <th>{{ __('Address') }}</th>
                                    <td>{{ $project->address }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Min invest') }}</th>
                                    <td>{{ $project->min_invest }}</td>
                                    <th>{{ __('Max invest') }}</th>
                                    <td>{{ $project->max_invest }}</td>
                                    <th>{{ __('Max invest Amount') }}</th>
                                    <td>{{ $project->max_invest_amount }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Description') }}</th>
                                    <td>{{ $project->meta->value['description'] ?? '' }}</td>
                                    <th>{{ __('Is period') }}</th>
                                    <td>
                                        <div class="badge badge-{{ $project->is_period ? 'success':'warning' }}">
                                            {{ $project->is_period ? 'Yes':'No' }}
                                        </div>
                                    </td>
                                    <th>{{ __('Created At') }}</th>
                                    <td>{{ formatted_date($project->created_at) }}</td>
                                </tr>
                                @if ($project->is_period)
                                <tr>
                                    <th colspan="3">{{ __('Period duration') }}</th>
                                    <td colspan="3">{{ $project->period_duration }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
