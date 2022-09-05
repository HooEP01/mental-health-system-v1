@extends('layouts.auth')
@section('content')
<div class="container pt-3">
    <div class="row">
        <div class="col-md-8 p-2">
            <h5 class="fw-bold ps-1">Approve Appointment</h5>
        </div>
        <div class="col-md-2 p-2 d-grid">
            
        </div>
        <div class="col-md-2 p-2 d-grid">
            <a class="btn btn-outline-dark" href="{{route('professional.event.view')}}">< Back</a>
        </div>
        <div class="col-md-12 p-2">
            <div class="card">
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Event</th>
                        <th scope="col">Start</th>
                        <th scope="col">End</th>
                        <th scope="col">Status</th>
                        <th scope="col">Reason</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="list" id="list">                   
                    
                    </tbody>
                    </table>

                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let appointments = {{ Js::from($appointments) }};
    let appointmentData = appointments['data'];
    const approveStatus = [];

    let status = 'approve';
    for(let i = 0; i < appointmentData.length; i++){
        if(appointmentData[i]['status'] === status){
            approveStatus.push({
                id: appointmentData[i]['id'],
                user_id: appointmentData[i]['user_id'],
                event_id: appointmentData[i]['event_id'],
                professional_id: appointmentData[i]['professional_id'],
                start_datetime: appointmentData[i]['start_datetime'],
                end_datetime: appointmentData[i]['end_datetime'],
                status: appointmentData[i]['status'],
                reason: appointmentData[i]['reason'],
            })
        }
    }

    $(document).ready(function() {
        optionPrint();
    });

    function optionPrint()
    {
        let htmlStr = '';
        let count = 1;
        let list = document.getElementById('list');
        approveStatus.forEach(function (item) {
            htmlStr = htmlStr + `
                        <tr>
                        <th scope="row"> ${count} </th>
                        <td>${item.user_id}</td>
                        <td>${item.event_id}</td>
                        <td>${item.start_datetime}</td>
                        <td>${item.end_datetime}</td>
                        <td>${item.status}</td>
                        <td><textarea name="reason" id="reason" cols="30" rows="2" readonly>${item.reason}</textarea></td>
                        <td><a class="btn btn-outline-primary" href="{{route('professional.appointment.approve', '')}}"+"/"+${item.id}>Approve</a></td>
                        </tr>
            `;
            count++;
        })
        list.innerHTML = htmlStr;
    }

    console.log(approveStatus);
    
    

</script>