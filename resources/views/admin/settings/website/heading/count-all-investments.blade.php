<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-feature-tab" data-toggle="tab" href="#{{ $key }}-feature" role="tab" aria-controls="{{ $key }}-feature" aria-selected="true">{{ $value }} ({{ $key }})</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-feature" role="tabpanel" aria-labelledby="{{ $key }}-feature-tab">
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.investments-count') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="short_title" class="required">{{ __('Short Title') }} ({{ $key }})</label>
                            <input type="text" name="short_title" id="short_title" class="form-control" value="{{ $headings['heading.investments-count'][$key]['short_title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.investments-count'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="background{{ $key }}" class="required">{{ __('Background Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_name' => 'background',
                                'input_id' => 'background'.$key,
                                'preview_class' => 'background'.$key,
                                'preview' => $headings['heading.investments-count'][$key]['background'] ?? null,
                                'value' => $headings['heading.investments-count'][$key]['background'] ?? null
                            ]) }}
                        </div>

                        <div class="form-group">
                            <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $headings['heading.investments-count'][$key]['description'] ?? null }}</textarea>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="feature_1_counter" class="required">{{ __('Feature 1 Count') }} ({{ $key }})</label>
                                            <input type="text" name="feature_1_counter" id="feature_1_counter" class="form-control" value="{{ $headings['heading.investments-count'][$key]['feature_1_counter'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_1_text" class="required">{{ __('Feature 1 Title') }} ({{ $key }})</label>
                                            <input type="text" name="feature_1_text" id="feature_1_text" class="form-control" value="{{ $headings['heading.investments-count'][$key]['feature_1_text'] ?? null }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="feature_2_counter" class="required">{{ __('Feature 2 Count') }} ({{ $key }})</label>
                                            <input type="text" name="feature_2_counter" id="feature_2_counter" class="form-control" value="{{ $headings['heading.investments-count'][$key]['feature_2_counter'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_2_text" class="required">{{ __('Feature 2 Title') }} ({{ $key }})</label>
                                            <input type="text" name="feature_2_text" id="feature_1_text" class="form-control" value="{{ $headings['heading.investments-count'][$key]['feature_2_text'] ?? null }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="feature_3_counter" class="required">{{ __('Feature 3 Count') }} ({{ $key }})</label>
                                            <input type="text" name="feature_3_counter" id="feature_3_counter" class="form-control" value="{{ $headings['heading.investments-count'][$key]['feature_3_counter'] ?? null }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_3_text" class="required">{{ __('Feature 3 Title') }} ({{ $key }})</label>
                                            <input type="text" name="feature_3_text" id="feature_3_text" class="form-control" value="{{ $headings['heading.investments-count'][$key]['feature_3_text'] ?? null }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
