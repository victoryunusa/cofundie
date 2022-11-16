@extends('layouts.backend.app', [
     'prev' => route('admin.projects.index'),
])

@section('title', __('Update project'))

@section('content')
    <form method="post" action="{{ route('admin.projects.update', $project->id) }}" class="ajaxform_with_redirect" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label>{{ __('Gallery Images') }}</label>
                                {{ mediasectionmulti([
                                    'input_name' => 'images[]',
                                    'input_id' => 'images',
                                    'preview_class' => 'images',
                                    'value' => $project->meta->value['galleries'] ?? null,
                                ]) }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>{{ __('Thumbnail Image') }}</label>
                                {{ mediasection([
                                    'input_name' => 'thumbnail',
                                    'input_id' => 'thumbnail',
                                    'preview_class' => 'thumbnail',
                                    'preview' => $project->thumbnail ?? null,
                                    'value' => $project->thumbnail ?? null,
                                ]) }}
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>{{ __('Preview Image') }}</label>
                                {{ mediasection([
                                    'input_name' => 'preview',
                                    'input_id' => 'preview',
                                    'preview_class' => 'preview',
                                    'preview' => $project->preview ?? null,
                                    'value' => $project->preview ?? null,
                                ]) }}
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label>{{ __('Title') }}</label>
                                <input type="text" class="form-control" placeholder="{{ __('Project Title') }}" required="" name="title" value="{{ $project->title }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label for="invest_type">{{ __('Invest Type') }}</label>
                                <select name="invest_type" id="invest_type" class="form-control" required>
                                    <option value="">-{{ __('Select') }}-</option>
                                    <option @selected($project->invest_type == 1) value="1">{{ __('Percentage') }}</option>
                                    <option @selected($project->invest_type == 0) value="0">{{ __('Fixed') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label for="min_invest">{{ __('Minimum Invest') }}</label>
                                <input type="number" id="min_invest" class="form-control" placeholder="{{ __('Minimum Invest') }}" required="" name="min_invest" value="{{ $project->min_invest }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label for="">{{ __('Maximum Invest') }}</label>
                                <input type="number" id="max_invest" class="form-control" placeholder="{{ __('Maximum Invest') }}" required="" name="max_invest" value="{{ $project->max_invest }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label>{{ __('Maximum Investment Amount') }}</label>
                                <input type="number" class="form-control" placeholder="{{ __('Maximum Investment Amount') }}" required="" name="max_invest_amount" value="{{ $project->max_invest_amount }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label for="capital_back">{{ __('Capital Back') }}</label>
                                <select name="capital_back" id="capital_back" class="form-control" required>
                                    <option value="">-{{ __('Select') }}-</option>
                                    <option @selected($project->capital_back == 1) value="1">{{ __('Yes') }}</option>
                                    <option @selected($project->capital_back == 0) value="0">{{ __('No') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label for="is_period">{{ __('Is Period') }}</label>
                                <select name="is_period" id="is_period" class="form-control" required>
                                    <option value="">-{{ __('Select') }}-</option>
                                    <option @selected($project->is_period == 1) value="1">{{ __('Yes') }}</option>
                                    <option @selected($project->is_period == 0) value="0">{{ __('No') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3 period_duration {{ $project->is_period ? '':'d-none' }}">
                                <label for="period_duration">{{ __('Period Duration') }}</label>
                                <select name="period_duration" id="period_duration" class="form-control" required>
                                    <option value="">-{{ __('Select') }}-</option>
                                    <option @selected($project->period_duration == 'monthly') value="monthly">{{ __('Monthly') }}</option>
                                    <option @selected($project->period_duration == 'yearly') value="yearly">{{ __('Yearly') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label>{{ __('Profit Range') }}</label>
                                <input type="text" class="form-control" placeholder="{{ __('Profit range') }}" required="" name="profit_range" value="{{ $project->profit_range }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label>{{ __('Loss Range') }}</label>
                                <input type="text" class="form-control" placeholder="{{ __('Loss range') }}" required="" name="loss_range" value="{{ $project->loss_range }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label>{{ __('Location') }}</label>
                                <input type="url" class="form-control" placeholder="{{ __('Only embed url accepted.') }}" required="" name="location" value="{{ $project->meta->value['location'] ?? '' }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label>{{ __('Address') }}</label>
                                <input type="text" class="form-control" placeholder="{{ __('Address') }}" required="" name="address" value="{{ $project->address }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label for="status">{{ __('Status') }}</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">-{{ __('Select') }}-</option>
                                    <option @selected($project->status == 1) value="1">{{ __('Active') }}</option>
                                    <option @selected($project->status == 0) value="0">{{ __('Deactive') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3">
                                <label for="accept_new_investor">{{ __('Accept new investor') }}</label>
                                <select name="accept_new_investor" id="accept_new_investor" class="form-control" required>
                                    <option value="">-{{ __('Select') }}-</option>
                                    <option @selected($project->accept_new_investor == 1) value="1">{{ __('Yes') }}</option>
                                    <option @selected($project->accept_new_investor == 0) value="0">{{ __('No') }}</option>
                                </select>
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3 align-self-center mt-4">
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="accept_installments" {{ $project->accept_installments ? 'checked':'' }} class="custom-switch-input" value="1">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">{{ __('Is Accept Installments') }}</span>
                                </label>
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3 accept_installments {{ $project->accept_installments ? '':'d-none' }}">
                                <label for="installment_amount">{{ __('Installment Amount') }}</label>
                                <input type="number" id="installment_amount" class="form-control" step="any" placeholder="{{ __('Installment Amount') }}" required="" name="installment_amount" value="{{ $project->installment->value['installment_amount'] ?? '' }}">
                            </div>
                            <div class="col-sm-6 col-md-4 mb-3 accept_installments {{ $project->accept_installments ? '':'d-none' }}">
                                <label for="total_installments">{{ __('Total Installments') }}</label>
                                <input type="number" id="total_installments" class="form-control" step="any" placeholder="{{ __('Total Installments') }}" required="" name="total_installments" value="{{ $project->installment->value['total_installments'] ?? '' }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3 accept_installments {{ $project->accept_installments ? '':'d-none' }}">
                                <label>{{ __('Installment Duration') }}</label>
                                <input type="number" class="form-control" step="any" placeholder="{{ __('Ex: Days') }}" required="" name="installment_duration" value="{{ $project->installment->value['installment_duration'] ?? '' }}">
                            </div>

                            <div class="col-sm-6 col-md-4 mb-3 accept_installments {{ $project->accept_installments ? '':'d-none' }}">
                                <label>{{ __('Installment Late Fee') }}</label>
                                <input type="number" class="form-control" step="any" placeholder="{{ __('Installment late fees') }}" required="" name="late_fees" value="{{ $project->installment->value['late_fees'] ?? '' }}">
                            </div>

                            <div class="col-sm-12 mb-3">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea name="description" id="description" cols="30" rows="10" placeholder="{{ __('Project Description') }}" class="form-control summernote">{{ $project->meta->value['description'] ?? '' }}</textarea>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="form-group field_wrapper">
                                    <div class="row">
                                        <div class="col-md-6 align-self-end">
                                            <label for="">{{ __('Text') }}</label>
                                        </div>
                                        <div class="col-md-5 align-self-end">
                                            <label for="">{{ __('Number') }}</label>
                                        </div>
                                        <div class="col-md-1 text-right">
                                            <a href="javascript:" class="add_button text-xxs mr-2 btn btn-primary mb-0 btn-sm rounded-circle text-xxs ">
                                                <i class="fas fa-plus-circle d-inline-block mt-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @foreach ($project->meta->value['icon'] ?? [] as $key => $icon)
                                    <div class="row mb-2">
                                        <div class="col-md-6"><br>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="text[]" id="text" placeholder="Text" autocomplete="off" required value="{{ $project->meta->value['text'][$key] ?? '' }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary btn-sm myEditor_icon" data-icon="{{ $icon ?? '' }}" data-id="{{ $key }}">
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="icon[]" class="item-{{ $key }}" required value="{{ $icon ?? '' }}">
                                        </div>
                                        <div class="col-md-5"><br>
                                            <input type="number" name="item[]" class="form-control" placeholder="{{ __("Number") }}" required value="{{ $project->meta->value['item'][$key] ?? '' }}">
                                        </div>
                                        <div class="col-md-1 align-self-center text-right">
                                            <a href="javascript:void(0);" class="remove_button text-xxs mr-2 btn rounded-circle btn-danger mb-0 btn-sm text-xxs mt-3" title="Remove">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary col-12 basicbtn"><i class="fa fa-save"></i>
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{ mediasingle() }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css') }}"/>
@endpush

@push('script')
    <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/jquery-menu-editor.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-iconpicker/js/menu.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote.js') }}"></script>
    <script>
        $('.myEditor_icon').iconpicker();
    </script>
    @include('admin.projects.project-js')
@endpush
