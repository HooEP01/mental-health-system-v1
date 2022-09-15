@extends('layouts.auth')
@section('content')
<div class="container pt-3">
    <div class="row">
        <div class="col-md-10 p-2">
            <h5 class="fw-bold ps-1">Approve Appointment</h5>
        </div>
        <div class="col-md-2 p-2 d-grid">
            <a class="btn btn-dark" href="{{route('professional.event.view')}}">< Back</a>
        </div>
        <div class="col-md-12 p-2">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive rounded-lg">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Event</th>
                            <th scope="col">Start</th>
                            <th scope="col">End</th>
                            <th scope="col">
                                <select name="status" class="form-select" id="status" onchange="selection()">
                                        <option value="{{route('professional.appointment.view')}}">Status</option>
                                        <option value="{{route('professional.appointment.view')}}">All</option>
                                        <option value="{{route('professional.appointment.filter.status',['status'=>'Complete'])}}">Completed</option>
                                        <option value="{{route('professional.appointment.filter.status',['status'=>'Approve'])}}">Approved</option>
                                        <option value="{{route('professional.appointment.filter.status',['status'=>'Join'])}}">Joined</option>
                                        <option value="{{route('professional.appointment.filter.status',['status'=>'Cancel'])}}">Cancelled</option>
                                </select>
                            </th>
                            <th scope="col" style="width:300px">Reason</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody> 
                        @php
                            $count = 1;
                        @endphp
                        @foreach($appointments as $appointment)                  
                            <tr>
                            <th scope="row"> {{$count++}} </th>
                            <td>{{$appointment->user_id}}</td>
                            <td>{{$appointment->event_id}}</td>
                            <td>{{$appointment->start_datetime}}</td>
                            <td>{{$appointment->end_datetime}}</td>
                            <td>{{$appointment->status}}</td>
                            <td><textarea name="reason" id="reason" cols="30" rows="3" style="width:300px;" readonly>{{$appointment->reason}}</textarea></td>
                            <td>
                                <div class="d-grid gap-3 mx-auto">
                                    @if($appointment->status == 'Approve')
                                    <a class="btn btn-success" href="{{route('professional.appointment.complete', ['id'=>$appointment->id])}}">Complete</a>
                                    @elseif($appointment->status != 'Complete')
                                    <a class="btn btn-primary" href="{{route('professional.appointment.approve', ['id'=>$appointment->id])}}">Approve</a>
                                    @endif
                                    
                                    @if($appointment->status != 'Cancel')
                                    <a class="btn btn-danger" href="{{route('professional.appointment.cancel', ['id'=>$appointment->id])}}">Cancel</a>
                                    @endif
                                </div>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection



<script>
    function selection()
    {
        let status = document.getElementById('status').selectedIndex;
        let url = document.getElementById('status').options[status].value;
        window.location.href = url;
    }
    let data = <?php echo json_encode($appointments); ?>;
    console.log(data);
</script>