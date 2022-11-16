@extends('layouts.user.app')

@section('title', __('Investment Plans'))

@section('content')
<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>{{ __('All Plans') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>{{ __('Your Plans') }}</a>
        </li>
    </ul>
</div>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
        <div class="row">
            @foreach ($projects as $project)
            <div class="col-xl-6">
                <div class="card">
                    <a target="_blank" href="{{ route('frontend.properties.show', $project->slug) }}">
                        <img height="300px" class="card-img-top" src="{{ $project->thumbnail }}" alt="Image placeholder">
                    </a>
                    <div class="overlay card-body">
                        <a href="">
                            <h2 class="text-white font-weight-600">{{ $project->title }}</h2>
                            <p class="text-white font-weight-600"> <i class="fas fa-location-arrow"></i> {{ $project->address }}</p>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>{{ __('Profit Range') }}</p>
                                <h3 class="font-weight-bold">{{ $project->profit_range }}</h3>
                            </div>
                            <div class="col-md-6">
                                <p>{{ __('Loss Range') }}</p>
                                <h3 class="font-weight-bold">{{ $project->loss_range }}</h3>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-md-6">
                                <p>{{ __('Minimum invest') }}</p>
                                <h3 class="font-weight-bold">{{ currency_format($project->min_invest) }}</h3>
                            </div>
                            <div class="col-md-6">
                                <p>{{ __('Maximum invest') }}</p>
                                <h3 class="font-weight-bold">{{ currency_format($project->max_invest) }}</h3>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p>{{ __('Return For') }}</p>
                                <h3 class="font-weight-bold">{{ $project->is_period ? ucfirst($project->period_duration) : "Lifetime" }}</h3>
                            </div>
                            <div class="col-md-6">
                                <p>{{ __('Capital Back') }}</p>
                                <h3 class="font-weight-bold">{{ $project->capital_back ? 'Yes':'No' }}</h3>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="card-body py-0 pb-2">
                        @foreach ($project->meta->value['icon'] ?? [] as $key => $icon)
                            <li class="nav-link float-left"><i class="{{ $icon }}"></i> {{ $project->meta->value['item'][$key] ?? 0 }}</li>
                        @endforeach
                    </div>
                    <div class="card-body pt-0">

                        @if (in_array($project->id, $invests))
                        <button class="btn btn-neutral" type="button">{{ __('Already Invest') }}</button>
                        @elseif (!$project->accept_new_investor)
                        <button class="btn btn-danger" type="button">{{ __('Share not available') }}</button>
                        @else
                        @if (!$project->is_installment)
                        <button class="btn btn-primary invest-using" data-id="{{ $project->id }}" data-action="{{ route('user.invests.payment') }}">{{ __('Invest Now') }}</button>
                        <button class="btn btn-dark invest-using" data-id="{{ $project->id }}">{{ __('Invest Using Balance') }}</button>
                        @endif
                        @if ($project->accept_installments)
                        <button class="btn btn btn-google-plus installment-payment" data-id="{{ $project->id }}" data-action="{{ route('user.installments.index') }}">{{ __('Installment') }}</button>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
        <div class="row">
            @foreach ($investments as $investment)
            @php
                $project = $investment->project;
            @endphp
            <div class="col-xl-6">
                <div class="card">
                    <a target="_blank" href="{{ route('frontend.properties.show', $project->slug) }}">
                        <img height="300px" class="card-img-top" src="{{ $project->thumbnail }}" alt="Image placeholder">
                    </a>
                    <div class="overlay card-body">
                        <a href="">
                            <h2 class="text-white font-weight-600">{{ $project->title }}</h2>
                            <p class="text-white font-weight-600"> <i class="fas fa-location-arrow"></i> {{ $project->address }}</p>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p>{{ __('Profit Range') }}</p>
                                <h3 class="font-weight-bold">{{ $project->profit_range }}</h3>
                            </div>
                            <div class="col-md-6">
                                <p>{{ __('Loss Range') }}</p>
                                <h3 class="font-weight-bold">{{ $project->loss_range }}</h3>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-md-6">
                                <p>{{ __('Minimum invest') }}</p>
                                <h3 class="font-weight-bold">{{ currency_format($project->min_invest) }}</h3>
                            </div>
                            <div class="col-md-6">
                                <p>{{ __('Maximum invest') }}</p>
                                <h3 class="font-weight-bold">{{ currency_format($project->max_invest) }}</h3>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p>{{ __('Return For') }}</p>
                                <h3 class="font-weight-bold">{{ $project->is_period ? ucfirst($project->period_duration) : "Lifetime" }}</h3>
                            </div>
                            <div class="col-md-6">
                                <p>{{ __('Capital Back') }}</p>
                                <h3 class="font-weight-bold">{{ $project->capital_back ? 'Yes':'No' }}</h3>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="card-body py-0 pb-2">
                        @foreach ($project->meta->value['icon'] ?? [] as $key => $icon)
                            <li class="nav-link float-left"><i class="{{ $icon }}"></i> {{ $project->meta->value['item'][$key] ?? 0 }}</li>
                        @endforeach
                    </div>
                    <div class="card-body pt-0">

                        @if (in_array($project->id, $invests))
                        <button class="btn btn-neutral" type="button">{{ __('Already Invest') }}</button>
                        @elseif (!$project->accept_new_investor)
                        <button class="btn btn-danger" type="button">{{ __('Share not available') }}</button>
                        @else
                        <button class="btn btn-primary invest-using" data-id="{{ $project->id }}" data-action="{{ route('user.invests.payment') }}">{{ __('Invest Now') }}</button>
                        <button class="btn btn-dark invest-using" data-id="{{ $project->id }}">{{ __('Invest Using Balance') }}</button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


<div class="modal fade" id="invest-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="mb-0 h3 font-weight-bolder">{{ __('Invest Now') }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __("Close") }}">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ request('payment') == 'yes' ? route('user.invests.payment') : route('user.invests.store') }}" method="post" class="ajaxform_instant_reload payment-form">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="">{{ __('Enter amount') }}</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">{{ default_currency()->symbol }}</span>
                                </span>
                                <input type="number" step="any" class="form-control installment-amount" name="amount" required="" placeholder="0.00">
                                <input type="hidden" name="project_id" id="project_id" value="{{ request('project_id') }}">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3 installment-field d-none">
                            <label for="">{{ __('Late fees') }}</label>
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">{{ default_currency()->symbol }}</span>
                                </span>
                                <input type="number" step="any" class="form-control late-fees" required="" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3 from-wallet d-none">
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" name="is_wallet" id="customCheck2" type="checkbox">
                                <label class="custom-control-label" for="customCheck2">{{ __("Pay from wallet?") }}</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3 installment-field d-none">
                            <h3>{{ __('Total') }} : <span class="including-fees"></span></h3>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-neutral btn-block submit-btn">
                            <i class="fas fa-hand-holding-usd"></i>
                            {{ __('Invest Now') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@if (request('trigger') == 'invest-modal')
<script>
    $('#invest-modal').modal('show')
</script>
@endif
@endpush
