@extends('layouts.user')
@section('content')
<div class="container">
    <div class="row">
        
        @foreach($events as $event)
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id" value="{{ $event->id }}">
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
                            <a class="btn btn-primary" href="{{route('appointment.add.view',['id'=>$event->id])}}">Join</a>  
                            <a class="btn btn-danger float-end" href="{{route('professional.event.delete',['id'=>$event->id])}}">Delete</a>             
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection
