@extends('layouts.auth')
@section('content')
<div class="cointainer-fluid bg-white">
    <div class="container">
        <!-- header nav -->
        <ul class="nav">
            <!-- Content approve page -->
            <li class="nav-item">
                <a class="nav-link active ps-0 link-danger" aria-current="page" href="{{route('administrator.content.view')}}">Approve Content</a>
            </li>
            <!-- Event approve page -->
            <li class="nav-item">
                <a class="nav-link link-danger" href="">Approve Event</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link link-danger" href="">View User</a>
            </li>

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
            
        </div>
        <div class="col-md-12 p-2">
            <div class="card">
                <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">type</th>
                        <th scope="col">category</th>
                        <th scope="col">image</th>
                        <th scope="col">title</th>
                        <th scope="col">summary</th>
                        <th scope="col">status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">View</th>
                        <th scope="col">View</th>
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