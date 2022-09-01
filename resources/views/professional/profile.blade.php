<!-- Get: $users (ProfessionalController.view)
     Form: Professional_id, Title, Image, Bio, linkedln 
     Button: Save (Update), back                        -->

@extends('layouts.auth')
@section('content')
<div class="container pt-3">
    <div class="row mt-md-2 mb-md-3">
        <div class="col-md-6">
            <h5> My Profile</h5>
        </div>               
    </div>
    <div class="row">
        <div class="col-md-8 p-2">
            <div class="card">
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($users as $user)
                    <!-- form -->
                    <form action="{{route('professional.profile.update')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <!-- Professional id -->
                        <input type="hidden" id="id" name="id" value="{{$user->id}}">
                        <div class="row">
                            <div class="col-12 p-2"></div>

                            <!-- Title -->
                            <div class="col-4 p-2">
                                <label for="title">Title</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="title" required value="{{$user->title}}">
                                </div>
                            </div>   
                            <!-- Image -->
                            <div class="col-4 p-2">
                                <label for="image">Picture</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="image" name="image" placeholder="image" value="{{$user->image}}">
                                </div>
                            </div>   
                            <!-- Bio -->
                            <div class="col-4 p-2">
                                <label for="bio">Bio</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <textarea class="form-control" id="bio" name="bio" rows="4" required value="{{$user->bio}}"></textarea>
                                </div>
                            </div>
                            <!-- Linkedln -->
                            <div class="col-4 p-2">
                                <label for="linkedln">Linkedln</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="linkedln" name="linkedln" placeholder="https://www.linkedin.com/" required value="{{$user->linkedln}}">
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
