@extends('layouts.backend.app')

@section('title', __('Footer Settings'))
@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
@endsection
@section('content')
    <section class="section">

        <div class="section-body">
            <form action="{{ route('admin.settings.website.footer.store') }}" class="ajaxform" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Footer Settings') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="copyright">{{ __('Copyright Content') }}</label>
                            <input type="text" id="copyright" name="copyright" class="form-control" value="{{ $footer->copyright ?? null }}">
                        </div>
                        <div class="form-group">
                            <label for="about">{{ __('Footer About') }}</label>
                            <textarea id="about" name="about" class="form-control">{{ $footer->about ?? null }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="location">{{ __('Location') }}</label>
                            <input type="text" id="location" name="location" class="form-control" value="{{ $footer->location ?? null }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone Number') }}</label>
                            <input type="tel" id="phone" name="phone" class="form-control" value="{{ $footer->phone ?? null }}">
                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="background_image">{{ __('Footer Left Image') }}</label>
                                    {{ mediasection([
                                        'input_id' => 'footer_left',
                                        'input_name' => 'footer_left',
                                        'preview_class' => 'footer_left',
                                        'preview' => $footer->footer_left ?? 'frontend/img/icons/5.png',
                                        'value' => $footer->footer_left ?? 'frontend/img/icons/5.png'
                                    ]) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="background_image">{{ __('Footer Right Image') }}</label>
                                    {{ mediasection([
                                        'input_id' => 'footer_right',
                                        'input_name' => 'footer_right',
                                        'preview_class' => 'footer_right',
                                        'preview' => $footer->footer_right ?? 'frontend/img/icons/5.png',
                                        'value' => $footer->footer_right ?? 'frontend/img/icons/5.png'
                                    ]) }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card mt-4 repeater">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>{{ __('Footer Social Links') }}</h4>

                        <button type="button" class="btn btn-primary btn-sm" data-repeater-create>
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body" data-repeater-list="social">
                        @if(count($footer->social ?? []) > 0)
                            @foreach ($footer->social ?? [] as $key => $social)
                                <div class="input-group mb-3" data-repeater-item>
                                    <input type="text" name="icon_class" class="form-control icon_class" value="{{ $social->icon_class }}" placeholder="{{ __('Icon Class') }}" aria-label="{{ __('Icon Class') }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="{{ $social->icon_class }}"></i>
                                        </span>
                                    </div>
                                    <input type="url" name="website_url" class="form-control" value="{{ $social->website_url }}" placeholder="{{ __('Website url') }}" aria-label="{{ __('Website Url') }}" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-danger" type="button" data-repeater-delete>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="input-group mb-3" data-repeater-item>
                                <input type="text" name="icon_class" class="form-control icon_class" placeholder="{{ __('Icon Class') }}" aria-label="{{ __('Icon Class') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i></i>
                                    </span>
                                </div>
                                <input type="url" name="website_url" class="form-control" placeholder="{{ __('Website url') }}" aria-label="{{ __('Website Url') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-danger" type="button" data-repeater-delete>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>
    </section>

@endsection
@section('modal')
    {{ mediasingle() }}
@endsection
@push('script')
    <script src="{{ asset('plugins/jqueryrepeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('admin/pages/footer.js') }}"></script>
     <script src="{{ asset('plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/custom/media.js ') }}"></script>
@endpush
