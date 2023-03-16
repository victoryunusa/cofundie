@extends('layouts.backend.app', [
    'prev' => route('admin.users.index')
])

@section('title', __('User Profile'))

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-center flex-column">
                        <figure class="avatar avatar-lg">
                            <img
                                src="{{ $user->avatar ? asset($user->avatar) : get_gravatar($user->email) }}"
                                alt="{{ $user->name }}"
                            >
                        </figure>

                        <h3 class="mt-3 mx-auto">{{ $user->name }}</h3>

                        <ul class="list-group mt-4">
                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Account ID') }}</div>
                                <div class="font-weight-light">{{ $user->id }}</div>
                            </li>

                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Username') }}</div>
                                <div class="font-weight-light"><span>@</span>{{ $user->username }}</div>
                            </li>
                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Email') }}</div>
                                <div class="font-weight-light">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#sendEmailModal">
                                        {{ $user->email }} <i class="fas fa-paper-plane"></i>
                                    </a>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Account Status') }}</div>
                                <div class="font-weight-light">
                                    @if($user->status == 1)
                                       <span class="badge badge-primary">{{ __('Active') }}</span>
                                    @elseif($user->status == 0)
                                        <span class="badge badge-warning">{{ __('Inactive') }}</span>
                                    @elseif($user->status == 2)
                                        <span class="badge badge-danger">{{ __('Banned') }}</span>
                                    @endif
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="font-weight-bolder">{{ __('Email Verified At') }}</div>
                                <div class="font-weight-light">
                                   {{ formatted_date($user->email_verified_at) }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Other Information') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>{{ __('Total Post') }}</th>
                            <td>
                                {{ $user->posts()->count() }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('Total Extra Post') }}</th>
                            <td>{{ $user->extras()->count() }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Total Member Level') }}</th>
                            <td>{{ $user->levels()->count() }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Total Supporter') }}</th>
                            <td>{{  $user->supporters()->count() }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Total Follower') }}</th>
                            <td>{{  $user->followings()->count() }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('Total Earning') }}</th>
                            <td>{{ $totalIncome }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Extra Order') }}</h4>
                </div>
                <div class="card-body">
                    @if ($extraOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('Invoice ID') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Commission') }}</th>
                                    <th>{{ __('Purchase At') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($extraOrders as $sale)
                                    <tr>
                                        <td>{{ $sale->invoice_no }}</td>
                                        <td>
                                            @if($sale->buyer_id)
                                              <a href="{{ route('admin.users.show', $sale->buyer_id) }}">{{ $sale->buyer->name }}</a>
                                             @endif
                                        </td>
                                        <td>{{ currency_format($sale->price) }}</td>
                                        <td>{{ currency_format($sale->commission) }}</td>
                                        <td>{{ formatted_date($sale->created_at) }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            {{ $extraOrders->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @else
                        <x-data-not-found message="No order found"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Subscription') }}</h4>
                </div>
                <div class="card-body">
                    @if ($subscriptions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('Invoice ID') }}</th>
                                    <th>{{ __('Subscription Member') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Commission') }}</th>
                                    <th>{{ __('Purchase At') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subscriptions as $sale)
                                    <tr>
                                        <td>{{ $sale->invoice_no }}</td>
                                        <td>
                                            @if($sale->user_id)
                                                <a href="{{ route('admin.users.show', $sale->user_id) }}">{{ $sale->user->name }}</a>
                                            @endif
                                        </td>
                                        <td>{{ currency_format($sale->amount) }}</td>
                                        <td>{{ currency_format($sale->commission) }}</td>
                                        <td>{{ formatted_date($sale->created_at) }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            {{ $subscriptions->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @else
                        <x-data-not-found message="No Subscription found"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Supporters') }}</h4>
                </div>
                <div class="card-body">
                    @if ($supporters->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('Invoice ID') }}</th>
                                    <th>{{ __('Supporter') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Purchase At') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supporters as $sale)
                                    <tr>
                                        <td>{{ $sale->invoice_no }}</td>
                                        <td>
                                            @if($sale->supporter_id)
                                                <a href="{{ route('admin.users.show', $sale->supporter_id) }}">{{ $sale->supporter->name }}</a>
                                            @endif
                                        </td>
                                        <td>{{ currency_format($sale->amount) }}</td>
                                        <td>{{ formatted_date($sale->created_at) }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            {{ $supporters->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @else
                        <x-data-not-found message="No Supporter found"/>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="sendEmailModal" tabindex="-1" role="dialog" aria-labelledby="sendEmailModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendEmailModalTitle">{{ __('Send Email') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.users.send-email', $user->id) }}" method="POST" class="ajaxform_with_reset">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="subject" class="required">{{ __('Subject') }}</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('Enter email subject') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="message" class="required">{{ __('Message') }}</label>
                            <textarea name="message" id="message" class="form-control h-150" placeholder="{{ __('Enter message') }}" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary basicbtn">
                            <i class="fas fa-paper-plane"></i>
                            {{ __('Send') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

