
@extends('layouts.auth')

@section('content')
<div class="container p-3">
    
    <div class="row">
        <div class="col-md-12 p-2">
            <p>This is dashboard page...</p>
            <a class="btn btn-primary" href="{{route('professional.profile.view')}}">Profile Page</a>
        </div>
        
        @if(auth()->user()->is_admin == 1)
        <div class="col-md-12 p-2">
            <p>This is admin section...</p>
        </div>
        @endif
    </div>
</div>
@endsection