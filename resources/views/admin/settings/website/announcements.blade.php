@extends('layouts.backend.app')

@section('title', __('Announcements Settings'))

@section('content')
    <section class="section">
        <div class="section-body">
            <form action="{{ route('admin.settings.website.announcements.update', $announcements->id) }}" class="ajaxform" method="POST">
                @csrf
                @method("PUT")
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Announcements Settings') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">{{ __('Title') }}</label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{ $announcements->title ?? null }}">
                                </div>
                                <div class="form-group">
                                    <label for="status">{{ __('Status') }}</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">-{{ __('Select') }}-</option>
                                        <option @selected($announcements->status == 1) value="1">{{ __('Active') }}</option>
                                        <option @selected($announcements->status == 0) value="0">{{ __('Deactive') }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" placeholder="Button name 1" name="button_name_1" type="text"  value="{{ $announcements->button_name_1 ?? null }}">
                                        <input class="form-control" placeholder="Button link 3" name="button_link_1" type="text"  value="{{ $announcements->button_link_1 ?? null }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" placeholder="Button name 2" name="button_name_2" type="text"  value="{{ $announcements->button_name_2 ?? null }}">
                                        <input class="form-control" placeholder="Button link 2" name="button_link_2" type="text"  value="{{ $announcements->button_link_2 ?? null }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" placeholder="Button name 3" name="button_name_3" type="text"  value="{{ $announcements->button_name_3 ?? null }}">
                                        <input class="form-control" placeholder="Button link 3" name="button_link_3" type="text"  value="{{ $announcements->button_link_3 ?? null }}">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary submit-btn mt-3">{{ __('Save Changes') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('modal')
    {{ mediasingle() }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endpush

@push('script')
    <script src="{{ asset('plugins/summernote/summernote.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js') }}"></script>
@endpush
