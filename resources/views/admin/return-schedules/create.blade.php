@extends('layouts.backend.app', [
     'prev' => route('admin.return-schedules.index', request('project_id')),
])

@section('title', __('Create return schedule'))

@section('content')
    <form method="post" action="{{ route('admin.return-schedules.store', request('project_id')) }}" class="ajaxform_with_redirect form-horizontal" enctype="multipart/form-data" id="frmEdit">
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" required="" value="{{ request('project_id') }}" name="project_id">
                            <div class="col-sm-6 mb-3">
                                <label for="return_type">{{ __('Return Type') }}</label>
                                <select name="return_type" id="return_type" class="form-control" required>
                                    <option value="">-{{ __('Select') }}-</option>
                                    <option value="percentage">{{ __('Percentage') }}</option>
                                    <option value="fixed">{{ __('Fixed') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label for="profit_type">{{ __('Profit type') }}</label>
                                <select name="profit_type" id="profit_type" class="form-control" required>
                                    <option value="">-{{ __('Select') }}-</option>
                                    <option value="profit">{{ __('Profit') }}</option>
                                    <option value="loss">{{ __('Loss') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label>{{ __('Amount') }}</label>
                                <input type="number" class="form-control" placeholder="{{ __('Amount') }}" required="" name="amount">
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label>{{ __('Attachment') }}</label>
                                <input type="file" class="form-control" placeholder="{{ __('Attachment') }}" name="attachment">
                            </div>

                            <div class="col-sm-6 mb-3">
                                <label>{{ __('Return date') }}</label>
                                <input type="date" class="form-control" required="" name="return_date">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary col-12 basicbtn mt-3"><i class="fa fa-save"></i>
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
