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
                    <form class="ajaxform" action="{{ route('admin.settings.website.heading.update-property') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="page_title" class="required">{{ __('Page Title') }} ({{ $key }})</label>
                            <input type="text" name="page_title" id="page_title" class="form-control" value="{{ $headings['heading.property'][$key]['page_title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="page_description" class="required">{{ __('Page Description') }} ({{ $key }})</label>
                            <input type="text" name="page_description" id="page_description" class="form-control" value="{{ $headings['heading.property'][$key]['page_description'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="short_title" class="required">{{ __('Short Title') }} ({{ $key }})</label>
                            <input type="text" name="short_title" id="short_title" class="form-control" value="{{ $headings['heading.property'][$key]['short_title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="title" class="required">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $headings['heading.property'][$key]['title'] ?? null }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="required">{{ __('Description') }} ({{ $key }})</label>
                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $headings['heading.property'][$key]['description'] ?? null }}</textarea>
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
