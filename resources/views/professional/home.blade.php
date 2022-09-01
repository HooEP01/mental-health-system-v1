
@extends('layouts.auth')

@section('content')
<div class="container p-3">
    
    <div class="row">

        <div class="col-12">
            <h4 class="fw-bold">Professional Dashboard</h4>
        </div>
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8"><h5 class="fw-bold">MyAppointment <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">10</span></h5></div>
                        <div class="col-4 float-end"><a class="btn btn-primary float-end" href="{{route('schedule.view')}}">View</a> </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8"><h5 class="fw-bold">MyContent <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">10</span></h5></div>
                        <div class="col-4 float-end"><a class="btn btn-primary float-end" href="{{route('professional.content.view')}}">View</a> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8"><h5 class="fw-bold">Professional Profile</div>
                        <div class="col-4 float-end"><a class="btn btn-primary float-end" href="{{route('professional.profile.view')}}">View</a> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 pt-md-5">

        </div>

        @if(auth()->user()->is_admin == 1)
        
        <div class="col-12">
            <h4 class="fw-bold">Admin Dashboard</h4>
        </div>

        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8"><h5 class="fw-bold">Message<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">30</span></div>
                        <div class="col-4 float-end"><a class="btn btn-primary float-end" href="{{route('professional.profile.view')}}">View</a> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8"><h5 class="fw-bold">Event</div>
                        <div class="col-4 float-end"><a class="btn btn-primary float-end" href="{{route('professional.profile.view')}}">View</a> </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8"><h5 class="fw-bold">Content</div>
                        <div class="col-4 float-end"><a class="btn btn-primary float-end" href="{{route('professional.profile.view')}}">View</a> </div>
                    </div>
                </div>
            </div>
        </div>

        @endif

        <div class="col-12 pt-md-5">

        </div>


        
    </div>

</div>
@endsection