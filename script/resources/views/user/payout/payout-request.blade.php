@extends('layouts.user.app')

@section('title', __('Make Payout'))

@section('content')
    <div class="row justify-content-center search-table">
        <div class="col-sm-12">
            <div class="card radius-card card-primary">
                <div class="card-header">
                    <h2 class="text-primary pb-0">
                        <a class="btn btn-primary btn-sm rounded-pill" href="{{ route('user.payout.index') }}"><i class="fa fa-backward" aria-hidden="true"></i> {{ __('Back') }}</a> &nbsp;
                        {{ __($method->name) }}
                    </h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('user.payout.get-otp', $method->id) }}" method="post" class="ajaxform_instant_reload mb-5">
                        @csrf
                        <div class="input-group">
                            <input type="number" name="amount" class="form-control" placeholder="{{ __('Payout amount') }}" required>
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-icon submit-btn">{{ __('Go') }} <i class="fas fa-forward"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-body">
                    <h3 class="text-primary mb-4">{{ __('Your credentials') }}</h3>
                    <div class="p-3">
                        <div class="row">
                            @php
                                $fields = json_decode($method->data);
                                $datas = json_decode($usermethod->payout_infos);
                            @endphp
                            <table class="table table-striped">
                            @foreach ($fields as $key => $field)
                                <tr>
                                    <td>{{ $field->label }}</td>
                                    <td>{{ $datas[$key]->data ?? '' }}</td>
                                </tr>
                            @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-primary">
                <div class="card-body">
                    <h3 class="text-primary mb-4">{{ __('Payout method information') }}</h3>
                    <div class="table-responsive pb-4">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('Method name') }}</th>
                                    <th>{{ __('Currency') }}</th>
                                    <th>{{ __('Minimum limit') }}</th>
                                    <th>{{ __('Maximum limit') }}</th>
                                    <th>{{ __('Charge type') }}</th>
                                    <th>{{ __('Charge') }}</th>
                                    <th>{{ __('Rate') }}</th>
                                    <th>{{ __('Delay') }}</th>
                                    <th>{{ __('Instraction') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ __($method->name) }}</td>
                                    <td>{{ $method->currency }}</td>
                                    <td>{{ $method->min_limit }}</td>
                                    <td>{{ $method->max_limit }}</td>
                                    <td>{{ $method->percent_charge ? 'Percentage':'Fixed'  }}</td>
                                    <td>{{ $method->percent_charge ?? $method->fixed_charge }}</td>
                                    <td>{{ $method->rate  }}</td>
                                    <td>{{ $method->delay }}</td>
                                    <td>{!! $method->instruction !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
