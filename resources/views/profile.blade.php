@extends('layouts.user')
@section('content')
<div class="container pt-3">
    <div class="row mt-md-2 mb-md-3">
        <!-- title -->
        <div class="col-md-10 p-2">
            <h5 class="fw-bold ps-1">Profile</h5>
        </div>          
        <!-- back button -->
        <div class="col-md-2 p-2 d-grid">
            <a class="btn btn-dark" href="{{route('home')}}">< Back</a>
        </div>  

        <div class="col-md-12 p-2">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($users as $user)
                    <!-- form -->
                    <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <input type="hidden" id="id" name="id" value="{{$user->id}}">
                        <div class="row"> 
                            <div class="col-md-2 p-2">
                                <label for="birthday" class="form-label">Birthday</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="birthday" name="birthday" required value="{{$user->birthday}}">
                                </div>
                            </div>  
                            <div class="col-md-2 p-2">
                                <label for="gender" class="form-label">Gender</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-2 p-2">
                                <label for="language" class="form-label">Language</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <select name="language" id="language" class="form-select" required>
                                        <option value="English">English</option>
                                        <option value="Malay">Malay</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Tamil">Tamil</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-2 p-2">
                                <label for="second_language" class="form-label">Relationship Status</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <select name="second_language" id="second_language" class="form-select" required>
                                        <option value="Married">Married</option>
                                        <option value="In Relationship">In Relationship</option>
                                        <option value="Single">Single</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-2 p-2">
                                <label for="contact_number" class="form-label">Contact Number</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="01X-XXX-XXXX" required value="{{$user->contact_number}}">
                                </div>
                            </div>  

                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary form-control">Save Change</button>
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
