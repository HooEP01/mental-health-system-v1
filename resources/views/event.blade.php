@extends('layouts.user')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 p-2">
            <div class="row">
                <!-- title -->
                <div class="col-md-6">
                    <h5 class="fw-bold ps-1">Event</h5>
                </div>
            
            </div>
        </div>
        @foreach($events as $event)
        <div class="col-md-4 p-2 d-flex align-items-stretch">
            <img src="{{ asset('event/')}}/{{ $event->image }}" alt="" class="img-fluid rounded card-img-top">
        </div>
        <div class="col-md-8 p-2 d-flex align-items-stretch">    
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id" value="{{$event->id}}">
                        <div class="col-12">
                            <h3 class="pt-3 pb-2">{{ $event->title }}</h3>
                            <p>{!! $event->description !!}</p>
                        </div>
                        <div class="col-6">
                            <p>Attendance: {{ $event->attendance_quantity }}</p>  
                        </div>
                        <div class="col-6">
                            <p>Fee: RM {{ $event->amount }}</p>  
                        </div>
                        <div class="col-6">
                            Time: 
                        </div>    
                        <p><span class="badge bg-secondary">{{ $event->type }}</span></p>
     
                        <div class="col-12 pb-3 position-absolute bottom-0 d-grid">
                            <!-- Add Appointment btn -->
                            <a class="btn btn-outline-primary" href="{{route('user.appointment.add',['id'=>$event->id])}}">Join Event</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-md-12 p-2 d-flex">
            {{ $events->links() }} 
        </div>
    </div>
</div>
@endsection
