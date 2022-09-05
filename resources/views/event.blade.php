@extends('layouts.user')
@section('content')
<div class="container">
    <div class="row">
        @foreach($events as $event)
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id" value="{{$event->id}}">
                        <div class="col-12">
                            <img src="{{ asset('event/')}}/{{ $event->image }}" alt="" class="img-fluid rounded card-img-top">
                        </div>
                        <div class="col-12">
                            <h3 class="pt-3 pb-2">{{ $event->title }}</h3>
                            <p>{{ $event->description }}</p>
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
     
                        <div class="col-12 pt-2">
                            <div class="d-grid gap-3 mx-auto">
                             <!-- Add Appointment btn -->
                                <a class="btn btn-outline-primary" href="{{route('appointment.add',['id'=>$event->id])}}">Join Event</a>
                            </div>  
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
