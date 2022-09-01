@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 p-2">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @foreach($users as $user)
                        <!-- form -->
                        <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                            
                            <input type="hidden" id="id" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-4 p-2">
                                    <label for="fullname">Full Name</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="fullname" required value="{{$user->full_name}}">
                                    </div>
                                </div>   
                                <div class="col-4 p-2">
                                    <label for="year_of_birth">Year of Birth</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="year_of_birth" name="year_of_birth" placeholder="year_of_birth" required value="">
                                    </div>
                                </div>  
                                <div class="col-4 p-2">
                                    <label for="account-username">Gender</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-4 p-2">
                                    <label for="account-username">First Language</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <select name="first_language" id="first_language" class="form-control" required>
                                            <option value="English">English</option>
                                            <option value="Malay">Malay</option>
                                            <option value="Chinese">Chinese</option>
                                            <option value="Tamil">Tamil</option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-4 p-2">
                                    <label for="second_language">Second Language</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <select name="second_language" id="second_language" class="form-control" required>
                                            <option value="Malay">Malay</option>
                                            <option value="English">English</option>
                                            <option value="Chinese">Chinese</option>
                                            <option value="Tamil">Tamil</option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-4 p-2">
                                    <label for="second_language">Relationship Status</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <select name="second_language" id="second_language" class="form-control" required>
                                            <option value="Married">Married</option>
                                            <option value="In Relationship">In Relationship</option>
                                            <option value="Single">Single</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="col-12">
                                    <i><a class="btn btn-primary" href="{{ route('home') }}">Save Change</a></i>
                                    <i><a class="btn btn-secondary" href="{{ route('home') }}">Back</a></i>
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
