@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 p-2">
            <p>This is dashboard page...</p>
            <a class="btn btn-primary" href="{{route('user.profile.view')}}">Profile Page</a>
        </div>
    </div>
</div>
@endsection
