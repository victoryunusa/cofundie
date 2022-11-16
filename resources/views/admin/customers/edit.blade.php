@extends('layouts.backend.app', [
    'prev' => route('admin.customers.index')
])

@section('title', __('Edit Customer'))

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Edit Customer') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.customers.update', $customer->id) }}" class="ajaxform_with_redirect">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="business_name" class="required">{{ __('Business Name') }}</label>
                            <input type="text" name="business_name" id="business_name" class="form-control" value="{{ $customer->business_name }}"
                                   placeholder="{{ __('Enter full name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="name" class="required">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name }}"
                                   placeholder="{{ __('Enter full name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">{{ __('Email') }}</label>
                            <input type="email" id="email" class="form-control"
                                   value="{{ $customer->email }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="support_email" class="required">{{ __('Support Email') }}</label>
                            <input type="email" id="support_email" class="form-control"
                                   value="{{ $customer->support_email }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="phone">{{ __('Phone Number') }}</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ $customer->phone }}"
                                   placeholder="{{ __('Enter phone number') }}">
                        </div>

                        <div class="form-group">
                            <label for="wallet">{{ __('Wallet') }}</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ default_currency('symbol') }}</span>
                                </div>
                                <input type="number" class="form-control" placeholder="{{ __('Wallet Balance') }}" value="{{ $customer->wallet }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary float-right basicbtn">
                                <i class="fas fa-save"> </i>
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <img src="{{ avatar($customer) }}" alt="{{ $customer->name }}" class="card-img">
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Other Information') }}</h5>

                    <ul class="list-unstyled">
                        <li>
                            {{ __('Trading Name: :name', ['name' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Description: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Staff Size: :number', ['number' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Industry: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Category: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Phone: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Address: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Email: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Website: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Gender: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Business Type: :text', ['text' => 'ABCD']) }}
                            <br>
                            <a href="">{{ __('View proof of address') }}</a>
                        </li>

                        <li>
                            {{ __('Full Name: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('DOB: :date', ['date' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('Nationality: :text', ['text' => 'ABCD']) }}
                        </li>
                        <li>
                            {{ __('ID Document: :text', ['text' => 'ABCD']) }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>{{ __('Registered At: :date', ['date' => formatted_date($customer->created_at)]) }}</li>
                        <li>{{ __('Updated At: :date', ['date' => formatted_date($customer->updated_at)]) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
