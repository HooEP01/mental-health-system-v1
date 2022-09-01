<script>
    let schedules = <?php echo json_encode($events); ?>;
    console.log(schedules);
</script>

@extends('layouts.user')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h4>Appointment</h4>
                    @foreach($events as $event)
                        <!-- form -->
                    <form action="{{route('appointment.add')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <!-- Event id -->
                        <input type="hidden" id="id" name="id" value=" {{$event->id }}">
                        <!-- User id -->
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                        
                        <div class="row">
                            <div class="col-12 p-2"></div>

                            <!-- Title -->
                            <div class="col-4 p-2">
                                <label for="reason">Reason</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                <textarea class="form-control" id="reason" name="reason" rows="4" required></textarea>
                                </div>
                            </div>    
                           
                            <!-- Start time -->
                            <div class="col-4 p-2">
                                <label for="start_datetime">Start Time</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="datetime-local"  class="form-control" id="start_datetime" name="start_datetime" rows="4" required value="{{ $event->start_datetime}}">
                                </div>
                            </div>  
                            
                            <!-- End time -->
                            <div class="col-4 p-2">
                                <label for="start_datetime">End Time</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="datetime-local"  class="form-control" id="end_datetime" name="end_datetime" rows="4" required value="{{ $event->end_datetime}}">
                                </div>
                            </div>  
                            
                            <!-- Fee -->
                            <div class="col-4 p-2">
                                <label for="amount">Price</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text"  class="form-control" id="amount" name="amount" rows="4" required value=" RM {{ $event->amount }}.00">
                                </div>
                            </div>  

                            <!-- Fee -->
                            <div class="col-4 p-2">
                                <label for="attendance_quantity">Attendance Left</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text"  class="form-control" id="attendance_quantity" name="attendance_quantity" rows="4" required value=" {{ $event->attendance_quantity }}">
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
                    <!--/ form -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
