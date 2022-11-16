@extends('layouts.user.app')

@section('title', __('Update your profile.'))

@section('content')
<form action="{{ route('user.profiles.update', auth()->id()) }}" method="post" class="ajaxform">
    @csrf
    @method('put')

    <div class="card">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-form-label col-lg-2">{{ __('Full Name') }}</label>
                <div class="col-lg-10">
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-2">{{ __('Email') }}</label>
                <div class="col-lg-10">
                    <input type="email" readonly class="form-control" value="{{ auth()->user()->email }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-2">{{ __('Avatar') }}</label>
                <div class="col-lg-10">
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-2">{{ __('Phone') }}</label>
                <div class="col-lg-10">
                    <input type="number" name="phone" class="form-control" value="{{ auth()->user()->phone }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-2">{{ __('Old password') }}</label>
                <div class="col-lg-10">
                    <input type="password" name="old_password" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-2">{{ __('New password') }}</label>
                <div class="col-lg-10">
                    <input type="password" name="new_password" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-2"></label>
                <div class="col-lg-10">
                    <button type="submit" class="btn btn-neutral btn-block submit-button"><i class="fas fa-save"></i>
                        {{ __('Save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
