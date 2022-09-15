@extends('layouts.auth')
@section('content')
<div class="container p-3">
    <!-- title -->
    <div class="row">
        <div class="col-md-12 p-2">
            <div class="row mt-md-2 mb-md-3">
                <!-- title -->
                <div class="col-md-6">
                    <h5 class="fw-bold ps-1">My Event Schedule</h5>
                </div>
                <div class="col-md-2 offset-md-4 d-grid">
                    <a class="btn btn-dark" href="{{route('professional.event.view')}}">Back</a>
                </div>                
            </div>
        </div>               
    </div>
    <div class="row">
        <div class="col-md-12 p-2">
            <div class="card">
                <div class="card-body">
                    <!-- form start -->
                    <form action="{{route('professional.event.schedule.create')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">  
                    @CSRF
                        <!-- Event id (foreign key)-->
                        <input type="hidden" id="event_id" name="event_id" value="{{ $event_id }}">
                        <div class="row">
                            <!-- Periodical -->
                            <div class="col-md-2 p-2">
                                <label for="periodical" class="form-label">Periodical</label>
                            </div>
                            <div class="col-md-10 p-2">
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
                            <div class="col-md-2 p-2">
                                <label for="startAt" class="form-label">Start At</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <input type="date" class="form-control" id="startAt" name="startAt" onchange="startAtCal()" required>
                            </div>
                            <!-- Start At -->
                            <div class="col-md-2 p-2">
                                <label for="endAt" class="form-label">End At</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <input type="date" class="form-control" id="endAt" name="endAt" required>
                            </div>

                            <!-- Time Start At -->
                            <div class="col-md-2 p-2">
                                <label for="time" class="form-label">Time Start At</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <input type="time" class="form-control" id="startTime" name="startTime" min=08:00 max=20:00 step=3600 value=08:00 onchange="startTimeCal()" required>
                            </div>

                            <!-- Time Start At -->
                            <div class="col-md-2 p-2">
                                <label for="endTime" class="form-label">Time End At</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <input type="time" class="form-control" id="endTime" name="endTime" min=08:00 max=20:00 step=3600 value=10:00  onchange="startTimeCal()" required>
                                <p id="displayTime" class="text-primary pt-2"></p>
                            </div>

                            <!-- submit -->
                            <div class="col-md-2 p-2"></div>
                            <div class="col-md-10 p-2">
                                <button type="submit" class="btn btn-primary form-control">Submit</button>
                            </div>
                    </form>
                    
                </div>
            </div>
        </div>


        @foreach($schedules as $schedule)
        
        @php
            $scheduleCount = 0;
        @endphp

        @if($scheduleCount == 0)
        <div class="row mt-5">
            <div class="col-md-6">
                <h5 class="fw-bold ps-1">My Event Schedule History</h5>
            </div>             
        </div>

        @php
            $scheduleCount++;
        @endphp

        @endif
        
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">Day</div>
                            <div class="col-4">: {{$schedule->day}}</div>
                            <div class="col-6"></div>
               
                            <div class="col-6">
                            <div class="row">
                                <div class="col-4">Start</div>
                                <div class="col-8">: {{$schedule->start_datetime}}</div>
                                <div class="col-4">End</div>
                                <div class="col-8">: {{$schedule->end_datetime}}</div>
                            </div>
                            </div>
                                
                            <div class="col-6 ">
                                <a class="btn btn-danger float-end" href="{{route('professional.event.schedule.delete',['id'=>$schedule->id])}}">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="list" class="list">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

      

    </div>
</div>

@endsection



<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let data = {{ Js::from($schedules) }};
    $(document).ready(
        function(){
            document.addEventListener("load", periodicalCal());
            let list = document.getElementById('list');
            let htmlStr = ''
            sortedAsc.forEach(function (item){
                htmlStr = htmlStr + `
                            <div class="item">
                                <div>
                                    <p>Time: ${item.date} </p>
                                </div>
                            </div>`;
                list.innerHTML = htmlStr;
            })
        }
    );

    function periodicalCal() {
        // daily, weekly, biweekly, monthly, yearly
        let periodical = document.getElementById('periodical').value;
        let today = new Date();
        // this month
        let month = (today.getMonth()+1 > 9)? today.getMonth()+1 : '0'+ (today.getMonth()+1);
        // this date
        let date = (today.getDate() > 9)? today.getDate() : '0'+ today.getDate();
        // result format 2022-01-01
        let result = today.getFullYear()+'-'+month+'-'+date;
        // set only show future date.
        startAt.setAttribute("min", result);
        endAt.setAttribute("min", result);
    
        if( periodical === "Daily" ){
            dayChange.innerHTML = ` <input type="hidden" id="day" name="day" value="7">`;
            startAt.setAttribute("step", 0);
            endAt.setAttribute("step", 0);
        }else {
            dayChange.innerHTML = ` <div class="col-md-2 p-2">
                                        <label for="day" class="form-label">Day</label>
                                    </div>
                                    <div class="col-md-10 p-2">
                                        <select name="day" id="day" class="form-select" onchange="selectedDay()"  required>
                                            <option value="1">Monday</option>
                                            <option value="2">Tuesday</option>
                                            <option value="3">Wednesday</option>
                                            <option value="4">Thursday</option>
                                            <option value="5">Friday</option>
                                            <option value="6">Saturday</option>
                                            <option value="0">Sunday</option>
                                        </select>
                                    </div>`;
            document.addEventListener("load", selectedDay());

            if(periodical === "Weekly"){
                startAt.setAttribute("step", 7);
                endAt.setAttribute("step", 7);
            }else if(periodical === "Biweekly"){
                startAt.setAttribute("step", 14);
                endAt.setAttribute("step", 14);
            }else if(periodical === "Monthly"){
                startAt.setAttribute("step", 28);
                endAt.setAttribute("step", 28);
            }else{
                startAt.setAttribute("step", 365);
                endAt.setAttribute("step", 365);
            }
            
        }
    }

    function startTimeCal() {
        let startTime = document.getElementById("startTime").value;
        endTime.setAttribute("min", startTime);
    }

    function startAtCal() {
        let startDate = document.getElementById("startAt").value;
        endAt.setAttribute("min", startDate);
        document.getElementById('endAt').value = startDate;
    }

    function selectedDay() {
        document.getElementById('startAt').value = "";
        document.getElementById('endAt').value = "";
        // Monday, Tuesday...
        let day = document.getElementById("day").value;
        let today = new Date();
        // this month
        let month = (today.getMonth() + 1 > 9)? today.getMonth()+1 : '0'+ (today.getMonth()+1);
        // this date
        let date = ((today.getDate() - today.getDay() + parseInt(day)) + 7 > 9)? (today.getDate() - today.getDay() + parseInt(day)) + 7 : '0'+ (today.getDate() - today.getDay() + parseInt(day) + 7);
        
        if( date === "0" + (today.getDate() + 7)){
            date = (today.getDate() > 9)? today.getDate() : '0'+ today.getDate();
        }
        // result format 2022-01-01
        let result = today.getFullYear()+'-'+month+'-'+date;
        startAt.setAttribute("min", result);
        endAt.setAttribute("min", result);
    }

    // print schedules 
    const arraySchedule = [];
    for(let i = 0; i < data.length; i++){
        let startDatetime = new Date(data[i]['start_datetime']);
        let endDatetime = new Date(data[i]['end_datetime']);
        let startDate = startDatetime.getDate();
        let endDate = endDatetime.getDate();
        let startHour = startDatetime.getHours();
        let endHour = endDatetime.getHours();
        let startTime = startDatetime.getTime();
        let endTime = endDatetime.getTime();
        let periodical = data[i]['periodical'];
        let differenceDate = Math.ceil((endTime - startTime) / (1000 * 3600 * 24));
        let step = 1;
        if(periodical === "Daily"){
            step = 1;
        }else if(periodical === "Weekly"){
            step = 7;
        }else if(periodical === "Biweekly"){
            step = 14;
        }else if(periodical === "Monthy"){
            step = 28;
        }else if(periodical === "Yearly"){
            step = 365;
        }

        let currentDatetime = new Date(data[i]['start_datetime']);
        for(let j = 0; j < differenceDate; j+=step){
            let h = 0;
            for(let k = startHour; k < endHour; k++){
                currentDatetime.setHours(currentDatetime.getHours() + (h++));
                arraySchedule.push({
                    date: new Date(currentDatetime),
                });
            }
            currentDatetime.setDate(currentDatetime.getDate() + step);
            currentDatetime.setHours(startHour);
        }
    }
    
    // sort in ascending order 
    const sortedAsc = arraySchedule.sort(
        (objA, objB) => Number(objA.date) - Number(objB.date),
    );


</script>

