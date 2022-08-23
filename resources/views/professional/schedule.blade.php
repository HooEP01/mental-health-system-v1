
<style>
    #date{
        /* display:none (disappear) */
        display:block;
    }
</style>

<script>

    let schedules = <?php echo json_encode($schedules); ?>;

    for(let i = 0; i < schedules['data'].length; i++){
        /*
        let day = schedules['data'][i]['day'];
        let startTime = parseInt(schedules['data'][i]['start_time']);
        let hour = parseInt(schedules['data'][i]['hour']);
        let endTime = (startTime + hour) - 1;
        */
        
    }

    function selectedDay(){
        let day = document.getElementById("day").value;
        let date = document.getElementById("date");
        let startAt = document.getElementById("startAt");
        let endAt = document.getElementById("endAt");
        let hour = document.getElementById("hour");
        let time = document.getElementById("startTime");

        let today = 15 + parseInt(day);
        let strToday = "2014-09-" + today;

        startAt.setAttribute("min", strToday)
        endAt.setAttribute("min", strToday)
        date.style.display = "block";

        time.addEventListener('keyup', (event) => {
            let endTime = parseInt(event.target.value) + parseInt(hour.value)
            displayTime.innerText = calHour(endTime)
        });
        
        hour.addEventListener('keyup', (event) => {
            let endTime = parseInt(time.value) + parseInt(event.target.value)
            displayTime.innerText = calHour(endTime)
        });
    }
    
    function calHour(endTime){
        let amPm = "Time End Before: " + endTime + " : 00 / ";
        if(endTime > 12){
            amPm += (endTime - 12) + " : 00 pm"
        }else if(endTime === 12){
            amPm += endTime + ": 00 pm"
        }else{
            amPm += endTime + ": 00 am"
        }
        return amPm 
    }

    
</script>

@extends('layouts.auth')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">Schedule</div>
                <div class="card-body">
                    <!-- form start -->
                    <form action="{{route('schedule.add')}}" method="POST">  
                    @CSRF
                        <input type="hidden" id="professional_id" name="professional_id" value="{{ Auth::id() }}">
                        <label for="day">Day</label>
                        <div class="form-group">
                            <select name="day" id="day" class="form-control" onchange="selectedDay()" required>
                                <option value="6">Sunday</option>
                                <option value="0">Monday</option>
                                <option value="1">Tuesday</option>
                                <option value="2">Wednesday</option>
                                <option value="3">Thursday</option>
                                <option value="4">Friday</option>
                                <option value="5">Saturday</option>
                            </select>
                        </div>

                        <div id="date">
                            <label for="startAt" class="pt-2">Start At</label>
                            <input type="date" class="form-control" id="startAt" name="startAt" step=7 min=2014-09-08 required>
                            <label for="endAt" class="pt-2">End At</label>
                            <input type="date" class="form-control" id="endAt" name="endAt" step=7 min=2014-09-08 required>
                            <label for="time" class="pt-2">Time Start At</label>
                            <input type="time" class="form-control" id="startTime" name="startTime" min=08:00 max=16:00 step=3600 value=08:00 required>
                            <label for="hour" class="pt-2">Time End At</label>
                            <input type="number" class="form-control" id="hour" name="hour" min=1 max=9 placeholder="Minimum 1" value=1 required>
                            <p id="displayTime" class="text-primary pt-2"></p>
                        </div>
                        <button type="submit" class="form-control">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-header">Schedule History</div>
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