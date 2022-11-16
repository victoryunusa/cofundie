<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-latest-news-tab" data-toggle="tab" href="#{{ $key }}-latest-news" role="tab" aria-controls="{{ $key }}-latest-news" aria-selected="true">{{ $value }} ({{ $key }})</a>
                </li>
                @php
                    $i++;
                @endphp
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content tab-bordered" id="myTab3Content">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-latest-news" role="tabpanel" aria-labelledby="{{ $key }}-latest-news-tab">
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.update-our-assets') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.our-assets'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="short_title" class="required">{{ __('Short Title') }} ({{ $key }})</label>
                            <input type="text" name="short_title" id="short_title" class="form-control" value="{{ $headings['heading.our-assets'][$key]['short_title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="suggestions" class="required">{{ __('Suggestions') }} ({{ $key }})</label>
                            <input type="text" name="suggestions" id="suggestions" class="form-control" value="{{ $headings['heading.our-assets'][$key]['suggestions'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="welcome_animate_image_{{ $key }}" class="required">{{ __('Animate Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_name' => 'animate_image',
                                'input_id' => 'welcome_animate_image_'.$key,
                                'preview_class' => 'welcome_animate_image_'.$key,
                                'preview' => $headings['heading.our-assets'][$key]['animate_image'] ?? null,
                                'value' => $headings['heading.our-assets'][$key]['animate_image'] ?? null
                            ]) }}
                        </div>

                        <div class="form-group">
                            <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $headings['heading.our-assets'][$key]['description'] ?? null }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary basicbtn">
                                <i class="fas fa-save"></i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
    </div>
</div>
