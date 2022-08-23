@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                <div class="card-body">
                   <a class="btn btn-primary" href="{{ route('profile.view') }}">View</a> 
                </div>
            </div>
        </div>

        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">Event</div>
                <div class="card-body">
                   <a class="btn btn-primary" href="{{ route('profile.view') }}">View</a> 
                </div>
            </div>
        </div>

        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">Individual Counseling</div>
                <div class="card-body">
                   <a class="btn btn-primary" href="{{ route('profile.view') }}">View</a> 
                </div>
            </div>
        </div>

        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">Group Counseling</div>
                <div class="card-body">
                   <a class="btn btn-primary" href="{{ route('profile.view') }}">View</a> 
                </div>
            </div>
        </div>

        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">Content</div>
                <div class="card-body">
                   <a class="btn btn-primary" href="{{ route('profile.view') }}">View</a> 
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
