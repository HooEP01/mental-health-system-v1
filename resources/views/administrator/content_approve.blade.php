@extends('layouts.auth')
@section('content')
<div class="cointainer-fluid bg-white">
    <div class="container">
        <!-- header nav -->
        <ul class="nav">
            <!-- Content approve page -->
            <li class="nav-item">
                <a class="nav-link active ps-0" aria-current="page" href="{{route('administrator.content.view')}}">Content</a>
            </li>
            <!-- Event approve page 
            <li class="nav-item">
                <a class="nav-link" href="{{route('administrator.event.view')}}">Event</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{route('administrator.user.view')}}">User</a>
            </li>
            -->
        </ul>
    </div>
</div>
<div class="container pt-3">
    <div class="row">
        <div class="col-md-8 p-2">
            <h5 class="fw-bold ps-1">Approve Content</h5>
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