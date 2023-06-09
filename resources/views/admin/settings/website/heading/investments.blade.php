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
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.update-investments') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.investments'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="feature_1" class="required">{{ __('Feature 1') }} ({{ $key }})</label>
                            <input type="text" name="feature_1" id="feature_1" class="form-control" value="{{ $headings['heading.investments'][$key]['feature_1'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="feature_2" class="required">{{ __('Feature 1') }} ({{ $key }})</label>
                            <input type="text" name="feature_2" id="feature_2" class="form-control" value="{{ $headings['heading.investments'][$key]['feature_2'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="feature_3" class="required">{{ __('Feature 3') }} ({{ $key }})</label>
                            <input type="text" name="feature_3" id="feature_3" class="form-control" value="{{ $headings['heading.investments'][$key]['feature_3'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $headings['heading.investments'][$key]['description'] ?? null }}</textarea>
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
