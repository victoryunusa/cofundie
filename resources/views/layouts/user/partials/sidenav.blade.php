@php
    $logo = get_option('logo_setting');
@endphp
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ $logo['logo'] ?? config('app.name') }}" class="navbar-brand-img"
                    alt="{{ config('app.name') }}">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('user.dashboard.index')]) href="{{ route('user.dashboard.index') }}">
                            <i class="fas fa-home"></i>
                            <span class="nav-link-text">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('user.deposits.index')]) href="{{ route('user.deposits.index') }}">
                            <i class="fas fa-arrow-up"></i>
                            <span class="nav-link-text">{{ __('Deposit') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->is('user/invests*')]) href="#navbar-invest" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-dashboards">
                            <i class="fas fa-funnel-dollar"></i>
                            <span class="nav-link-text">{{ __('Invests') }}</span>
                        </a>
                        <div class="{{ request()->is('user/invests*') ? '':'collapse' }}" id="navbar-invest">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('user.invests.plans') }}" @class(['nav-link', 'active' => request()->is('invests/plans')])>{{ __('Investment Plan') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.invests.index') }}" @class(['nav-link', 'active' => request()->is('invests')])>{{ __('Investments') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.investments.log') }}" @class(['nav-link', 'active' => request()->is('invests')])>{{ __('Investments Log') }}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('user.installments.log')]) href="{{ route('user.installments.log') }}">
                            <i class="fab fa-meetup"></i>
                            <span class="nav-link-text">{{ __('Installments Log') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('user.transactions.index')]) href="{{ route('user.transactions.index') }}">
                            <i class="fas fa-money-check-alt"></i>
                            <span class="nav-link-text">{{ __('Transactions') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('user.earnings.index')]) href="{{ route('user.earnings.index') }}">
                            <i class="fas fa-percent"></i>
                            <span class="nav-link-text">{{ __('Earnings Log') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('user.payout.index')]) href="{{ route('user.payout.index') }}">
                            <i class="fas fa-credit-card"></i>
                            <span class="nav-link-text">{{ __('Payouts') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('user.supports.index')]) href="{{ route('user.supports.index') }}">
                            <i class="fas fa-flag-usa"></i>
                            <span class="nav-link-text">{{ __('Support') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Route::is('user.profiles.index')]) href="{{ route('user.profiles.index') }}">
                            <i class="fas fa-user"></i>
                            <span class="nav-link-text">{{ __('Profile') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
