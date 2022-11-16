<div class="header mb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0">@yield('title')</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('user.dashboard.index') }}"><i class="fas fa-home"></i></a></li>
                            @foreach (Request::segments() as $segment)
                                @if(!is_numeric($segment))
                                    @if ($loop->last)
                                        <li class="breadcrumb-item active" aria-current="page">
                                            {{ ucwords($segment) }}
                                        </li>
                                    @else
                                        <li class="breadcrumb-item" aria-current="page">
                                            {{ ucwords($segment) }}
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    @yield('actions')
                </div>
            </div>
        </div>
    </div>
</div>
