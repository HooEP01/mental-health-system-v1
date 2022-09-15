@extends('layouts.auth')
@section('content')
<div class="container p-3">
    <div class="row">
        <div class="col-md-12 p-2">
            <div class="row mt-md-2 mb-md-3">
                <!-- title -->
                <div class="col-md-6">
                    <h5 class="fw-bold ps-1">My Individual Counselling</h5>
                </div>
                <div class="col-md-2 offset-md-4 d-grid">
                    <a class="btn btn-primary" href="{{route('professional.event.add',['type'=>'individual'])}}">+ Event</a>
                </div>                
            </div>

            @php
                $groupCount = 0;
            @endphp


            @foreach($events as $event)

            @if($event->type == "Individual Counselling")
            
            <div class="row">
                <!-- image (event poster)-->
                <div class="col-md-4 d-flex align-items-stretch">
                    <img src="{{ asset('event/')}}/{{ $event->image }}" alt="" class="img-fluid rounded card-img-top">
                </div>
                <!-- event's content -->
                <div class="col-md-8 d-flex align-items-stretch">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- event id -->
                                <input type="hidden" id="id" name="id" value="{{ $event->id }}">
                                <!-- event title & description -->
                                <div class="col-md-12">
                                    <h3 class="pt-3 pb-2">{{ $event->title }}</h3>
                                    {!!$event->description!!}
                                </div>
                                <!-- price -->
                                <div class="col-md-6">
                                    <p>Price <span class="text-primary">RM {{ $event->amount }}.00</span></p>  
                                </div>
                                <!-- schedule -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>Time: </p> 
                                        </div>
                                        <div class="col-md-10">
                                            @foreach( $schedules as $schedule)
                                            @if($event->id == $schedule->event_id)
                                            <p>{{ $schedule->start_datetime }} to {{ $schedule->end_datetime}}</p>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>  
                                <!-- event button -->  
                                <div class="col-md-8 pb-3 position-absolute bottom-0 d-grid">
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="{{route('professional.event.edit',['id'=>$event->id])}}">Edit</a>  
                                        <a class="btn btn-outline-primary" href="{{route('professional.event.schedule.view',['id'=>$event->id])}}">Schedule</a>  
                                    </div>
                                </div>
                                <div class="col-md-4 pb-3 position-absolute bottom-0 end-0 d-grid">
                                    <a class="btn btn-danger float-end" href="{{route('professional.event.delete',['id'=>$event->id])}}">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        
            @if($groupCount == 0)
            <div class="row mt-md-5 mb-md-3">
                <div class="col-md-6">
                    <h5 class="fw-bold ps-1">My Group Counselling</h5>
                </div>
                <div class="col-md-2 offset-md-4 d-grid">
                    <a class="btn btn-dark" href="{{route('professional.event.add',['type'=>'group'])}}">+ Event</a>
                </div>                
            </div>

            @php
                $groupCount++;
            @endphp

            @endif

            @else

            <div class="row">
                <!-- image (event poster)-->
                <div class="col-md-4 d-flex align-items-stretch">
                    <img src="{{ asset('event/')}}/{{ $event->image }}" alt="" class="img-fluid rounded card-img-top">
                </div>
                <!-- event's content -->
                <div class="col-md-8 d-flex align-items-stretch">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- event id -->
                                <input type="hidden" id="id" name="id" value="{{ $event->id }}">
                                <!-- event title & description -->
                                <div class="col-md-12">
                                    <h3 class="pt-3 pb-2">{{ $event->title }}</h3>
                                    {!!$event->description!!}
                                </div>
                                <!-- price -->
                                <div class="col-md-6">
                                    <p>Price <span class="text-primary">RM {{ $event->amount }}.00</span></p>
                                    <p>Attendance Quantity <span class="text-success">{{ $event->attendance_quantity }}</span></p>  
                                    <p>Attendance Left <span class="text-danger">{{ $event->attendance_quantity }}</span></p>    
                                </div>
                                <!-- schedule -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>Time: </p> 
                                        </div>
                                        <div class="col-md-10">
                                            @foreach( $schedules as $schedule)
                                            @if($event->id == $schedule->event_id)
                                            <p>{{ $schedule->start_datetime }} to {{ $schedule->end_datetime}}</p>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>  
                                <!-- event button -->  
                                <div class="col-md-8 pb-3 position-absolute bottom-0 d-grid">
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="{{route('professional.event.edit',['id'=>$event->id])}}">Edit</a>  
                                        <a class="btn btn-outline-primary" href="{{route('professional.event.schedule.view',['id'=>$event->id])}}">Schedule</a>  
                                    </div>
                                </div>
                                <div class="col-md-4 pb-3 position-absolute bottom-0 end-0 d-grid">
                                    <a class="btn btn-danger float-end" href="{{route('professional.event.delete',['id'=>$event->id])}}">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endif

            @endforeach

            @if($groupCount == 0)
            <div class="row mt-md-5 mb-md-3">
                <div class="col-md-6">
                    <h5 class="fw-bold ps-1">My Group Counselling</h5>
                </div>
                <div class="col-md-2 offset-md-4 d-grid">
                    <a class="btn btn-dark" href="{{route('professional.event.add',['type'=>'group'])}}">+ Event</a>
                </div>                
            </div>
            @endif
        </div>
    </div>   
</div>
@endsection



<!-- include libraries(jQuery, bootstrap) -->
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    var app = {{ Js::from($events) }};
    console.log(app);

</script>