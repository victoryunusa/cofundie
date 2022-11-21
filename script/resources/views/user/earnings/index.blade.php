@extends('layouts.user.app')

@section('title', __('Earnings Log'))

@section('content')
<div class="card card-primary search-table">
    <div class="card-header pb-2">
        <h4>{{ __('Earnings Log') }}</h4>
        <form action="#" class="card-header-form">
            @csrf
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="{{ __("Plan Name") }}">
                <div class="input-group-btn">
                    <button class="btn btn-primary btn-icon"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive pb-5">
        <table class="table table-flush">
            <thead class="thead-light">
                <tr>
                    <th>{{ __('S/N') }}</th>
                    <th>{{ __('Plan Name') }}</th>
                    <th>{{ __('Earning Amount') }}</th>
                    
                    <th>{{ __('Payment Date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($earnings as $earning)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a target="_blank" href="{{ url('/properties/'.$earning->project->slug ?? '') }}">{{ $earning->project->title ?? '' }}</a></td>
                        <td>{{ currency_format($earning->amount) }}</td>
                        
                        <td>{{ formatted_date($earning->created_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-body pb-0">
        {{ $earnings->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
