@extends('layouts.auth')
@section('content')
<div class="container p-3">
    <div class="row">
        <div class="col-md-9 p-2">
            <div class="row mt-md-2 mb-md-3">
                <div class="col-md-6">
                    <h5>My Individual Counselling</h5>
                </div>
                <div class="col-md-2 offset-md-4 d-grid">
                    <a class="btn btn-outline-primary" href="{{route('professional.event.add',['type'=>'individual'])}}">+ Event</a>
                </div>                
            </div>
            @foreach($individuals as $individual)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id" value="{{ $individual->id }}">
                        <div class="col-12">
                            <img src="{{ asset('individual/')}}/{{ $individual->image }}" alt="" class="img-fluid rounded card-img-top">
                        </div>
                        <div class="col-12">
                            <h3 class="pt-3 pb-2">{{ $individual->title }}</h3>
                            <p>{{ $individual->description }}</p>
                        </div>
                        <div class="col-6">
                            <p>Price <span class="text-primary">RM {{ $individual->amount }}.00</span></p>  
                        </div>
                        <div class="col-6">
                            <p>Time</p> 
                        </div>    
                        <div class="col-md-6 pt-2">
                            <a class="btn btn-outline-primary" href="{{route('professional.event.edit',['id'=>$individual->id])}}">View Appointment</a>  
                            <a class="btn btn-outline-success ms-2" href="{{route('professional.event.edit',['id'=>$individual->id])}}">Edit Event</a>  
                        </div>
                        <div class="col-md-6 pt-2">
                            <a class="btn btn-outline-danger float-end" href="{{route('professional.event.delete',['id'=>$individual->id])}}">Delete Event</a>
                        </div>
                    </div>
                    
                </div>
            </div>

            @endforeach

            <div class="row mt-md-5 mb-md-3">
                <div class="col-md-6">
                    <h5> My Group Counselling</h5>
                </div>
                <div class="col-md-2 offset-md-4 d-grid">
                    <a class="btn btn-outline-primary" href="{{route('professional.event.add',['type'=>'group'])}}">+ Event</a>
                </div>                
            </div>

        @foreach($groups as $group)
            <div class="card mb-1">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id" value="{{ $group->id }}">
                        <div class="col-12">
                            <img src="{{ asset('group/')}}/{{ $group->image }}" alt="" class="img-fluid rounded card-img-top">
                        </div>
                        <div class="col-12">
                            <h3 class="pt-3 pb-2">{{ $group->title }}</h3>
                            <p>{{ $group->description }}</p>
                        </div>
                        <div class="col-6">
                            <p>Price <span class="text-primary">RM {{ $group->amount }}.00</span> </p>
                            <p>Attendance Quantity <span class="text-success">{{ $group->attendance_quantity }}</span></p>  
                            <p>Attendance Left <span class="text-danger">{{ $group->attendance_quantity }}</span></p>  
                        </div>
                        <div class="col-6">
                            <p>Time</p>
                        </div>
   
                        <p><span class="badge bg-secondary">{{ $group->type }}</span></p>
     
                        <div class="col-md-6 pt-2">
                            <a class="btn btn-outline-primary" href="{{route('professional.event.edit',['id'=>$group->id])}}">View Event</a>  
                            <a class="btn btn-outline-success ms-2" href="{{route('professional.event.edit',['id'=>$group->id])}}">Edit Event</a>  
                            
                        </div>
                        <div class="col-md-6 pt-2">
                            <a class="btn btn-outline-danger float-end" href="{{route('professional.event.delete',['id'=>$group->id])}}">Delete Event</a>
                        </div>
                    </div>
                    
                </div>
            </div>

        @endforeach
        

    </div>

        </div>

        
</div>
@endsection
