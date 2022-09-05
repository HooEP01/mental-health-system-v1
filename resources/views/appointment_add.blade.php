@extends('layouts.user')
@section('content')
<div class="container pt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Appointment</h4>
                    @foreach($events as $event)
                        <!-- form -->
                    <form action="{{route('appointment.create')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <!-- Event id -->
                        <input type="hidden" id="event_id" name="event_id" value="{{ $event->id }}">
                        <!-- User id -->
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                        
                        <div class="row">
                            <div class="col-12 p-2"></div>

                            <!-- Title -->
                            <div class="col-4 p-2">
                                <label for="reason" class="form-label">Reason</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                <textarea class="form-control" id="reason" name="reason" rows="4" required></textarea>
                                </div>
                            </div>    
                           
                            <!-- Start time -->

                            
                            <div class="col-md-4 p-2">
                                <label for="start_datetime" class="form-label">Start Time</label>
                            </div>
                            
                            <div class="col-md-8 p-2">
                                <select class="start_datetime form-select" id="start_datetime" name="start_datetime" onchange="endDateTime()" required>
                                </select>
                            </div>
                            <!--
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="datetime-local"  class="form-control" id="start_datetime" name="start_datetime" rows="4" required value="{{ $event->start_datetime}}">
                                </div>
                            </div>  
                            -->


                            <!-- End time -->
                            <div class="col-4 p-2">
                                <label for="end_datetime" class="form-label">End Time</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control end_datetime" id="end_datetime" name="end_datetime" required readonly>
                                </div>
                            </div>  
                            
                            <!-- Fee -->
                            <div class="col-4 p-2">
                                <label for="amount" class="form-label">Price (RM)</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text"  class="form-control" id="amount" name="amount" rows="4" required value="{{ $event->amount }}.00" readonly>
                                </div>
                            </div>  

                            <!-- Fee -->
                            <div class="col-4 p-2">
                                <label for="attendance_quantity" class="form-label">Attendance Left</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text"  class="form-control" id="attendance_quantity" name="attendance_quantity" rows="4" required value="{{ $event->attendance_quantity }}" readonly>
                                </div>
                            </div>  

                            <!-- Back Btn -->
                            <div class="col-4 p-2">
                                <a class="btn border-dark form-control" href="{{ route('professional.home') }}">Back</a>
                            </div>
                            <!-- Save Btn -->
                            <div class="col-8 p-2">
                                <button type="submit" class="btn btn-outline-primary form-control">Save Change</button>
                            <div>
                                
                        </div>
                    </form>
                    <!-- print one only -->
                    @break
                    <!--/ form -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(
        function(){

            let list = document.getElementById('start_datetime');
            let htmlStr = ''
            sortedAsc.forEach(function (item){
                htmlStr = htmlStr + `<option value="${item.date}" selected>${item.date}</option>`;
                list.innerHTML = htmlStr;
            })
        }
    );

    function endDateTime() {
        let dum = document.getElementById('start_datetime').value;
        let date = formatDate(new Date(dum));
        document.getElementById('end_datetime').value = date;
    }

    function padTo2Digits(num) {
        return num.toString().padStart(2, '0');
    }

    function formatDate(date) {
        return (
            [
            date.getFullYear(),
            padTo2Digits(date.getMonth() + 1),
            padTo2Digits(date.getDate()),
            ].join('-') +
            ' ' +
            [
            padTo2Digits(date.getHours() + 1),
            padTo2Digits(date.getMinutes()),
            padTo2Digits(date.getSeconds()),
            ].join(':')
        );
    }

    let data = <?php echo json_encode($events); ?>;
    console.log(data);
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
                    date: formatDate(new Date(currentDatetime)),
                });
            }
            currentDatetime.setDate(currentDatetime.getDate() + step);
            currentDatetime.setHours(startHour);
        }

        
    }
    
    const sortedAsc = arraySchedule.sort(
        (objA, objB) => Number(objA.date) - Number(objB.date),
    );

</script>