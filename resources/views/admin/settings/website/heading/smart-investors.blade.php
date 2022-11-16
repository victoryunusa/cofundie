<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-welcome-tab" data-toggle="tab" href="#{{ $key }}-welcome" role="tab" aria-controls="{{ $key }}-welcome" aria-selected="true">{{ $value }} ({{ $key }})</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-welcome" role="tabpanel" aria-labelledby="{{ $key }}-welcome-tab">
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.smart-investors') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.smart-investors'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="suggestions" class="required">{{ __('Suggestions') }} ({{ $key }})</label>
                            <input type="text" name="suggestions" id="suggestions" class="form-control" value="{{ $headings['heading.smart-investors'][$key]['suggestions'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="btn_text" class="required">{{ __('Button Text') }} ({{ $key }})</label>
                            <input type="text" name="btn_text" id="btn_text" class="form-control" value="{{ $headings['heading.smart-investors'][$key]['btn_text'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="btn_link" class="required">{{ __('Button Link') }} ({{ $key }})</label>
                            <input type="text" name="btn_link" id="btn_link" class="form-control" value="{{ $headings['heading.smart-investors'][$key]['btn_link'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="welcome_image_{{ $key }}" class="required">{{ __('Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_name' => 'image',
                                'input_id' => 'image'.$key,
                                'preview_class' => 'image'.$key,
                                'preview' => $headings['heading.smart-investors'][$key]['image'] ?? null,
                                'value' => $headings['heading.smart-investors'][$key]['image'] ?? null
                            ]) }}
                        </div>

                        <div class="form-group">
                            <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $headings['heading.smart-investors'][$key]['description'] ?? null }}</textarea>
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
