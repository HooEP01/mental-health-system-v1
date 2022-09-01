@extends('layouts.auth')
@section('content')

<div class="cointainer-fluid bg-white">
    <div class="container">
        <!-- header nav -->
        <ul class="nav">
            <!-- Event page -->
            <li class="nav-item">
                <a class="nav-link active ps-0" aria-current="page" href="{{route('professional.event.view')}}">Event Home Page</a>
            </li>
            <!-- home page -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('professional.home')}}">Event Setting</a>
            </li>
        </ul>
    </div>
</div>

<div class="container p-3">
    <div class="row mt-md-2 mb-md-3">
        <div class="col-md-6">
            <h5> My Event Schedule</h5>
        </div>               
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <!-- form start -->
                    <form action="{{route('professional.event.schedule.update')}}" method="POST">  
                    @CSRF
                        <!-- Event id (foreign key)-->
                        <input type="hidden" id="event_id" name="event_id" value="">
                        <div class="row">
                            <!-- Periodical -->
                            <div class="col-4 p-2">
                                <label for="periodical">Periodical</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <select name="periodical" id="periodical" class="form-select" onload="periodicalCal()" onchange="periodicalCal()" required>
                                        <option value="Daily" selected>Daily</option>
                                        <option value="Weekly">Weekly</option>
                                        <option value="Biweekly">Biweekly</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Yearly">Yearly</option>
                                    </select>
                                </div>
                            </div>  
                            <!-- Day -->
                            <div id="dayChange" class="row m-0 p-0">

                            </div>
                            <!-- Start At -->
                            <div class="col-4 p-2">
                                <label for="startAt">Start At</label>
                            </div>
                            <div class="col-8 p-2">
                                <input type="date" class="form-control" id="startAt" name="startAt" onchange="startAtCal()" required>
                            </div>
                            <!-- Start At -->
                            <div class="col-4 p-2">
                                <label for="endAt">End At</label>
                            </div>
                            <div class="col-8 p-2">
                                <input type="date" class="form-control" id="endAt" name="endAt" required>
                            </div>

                            <!-- Time Start At -->
                            <div class="col-4 p-2">
                                <label for="time">Time Start At</label>
                            </div>
                            <div class="col-8 p-2">
                                <input type="time" class="form-control" id="startTime" name="startTime" min=08:00 max=20:00 step=3600 value=08:00 onchange="startTimeCal()" required>
                            </div>

                            <!-- Time Start At -->
                            <div class="col-4 p-2">
                                <label for="endTime">Time End At</label>
                            </div>
                            <div class="col-8 p-2">
                                <input type="time" class="form-control" id="endTime" name="endTime" min=08:00 max=20:00 step=3600 value=10:00  onchange="startTimeCal()" required>
                                <p id="displayTime" class="text-primary pt-2"></p>
                            </div>

                            <!-- submit -->
                            <div class="col-4 p-2"></div>
                            <div class="col-8 p-2">
                                <button type="submit" class="form-control">Submit</button>
                            </div>
                    </form>
                    
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                @foreach($schedules as $schedule)
                    <div class="card p-2 mb-2">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-2">Day</div>
                                <div class="col-4">: {{$schedule->day}}</div>
                                <div class="col-6"></div>
               
                                <div class="col-6">
                                <div class="row">
                                    <div class="col-4">Start</div>
                                    <div class="col-8">: {{$schedule->start_date}}</div>
                                    <div class="col-4">End</div>
                                    <div class="col-8">: {{$schedule->end_date}}</div>
                                </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-4">Start</div>
                                        <div class="col-8">: {{$schedule->start_time}}</div>
                                        <div class="col-4">End</div>
                                        <div class="col-8">: {{$schedule->hour}}</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-danger" href="{{route('schedule.delete',['id'=>$schedule->id])}}">delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
