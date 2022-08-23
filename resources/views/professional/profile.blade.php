@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                            <input type="hidden" id="id" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-12 p-2">
                                    <h5 class="fw-bold">Profile</h5>
                                </div>
                                <div class="col-4 p-2">
                                    <label for="title">Title</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="title" required value="{{$user->title}}">
                                    </div>
                                </div>   
                                <div class="col-4 p-2">
                                    <label for="image">Picture</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="image" name="image" placeholder="image" value="{{$user->image}}">
                                    </div>
                                </div>   
                                <div class="col-4 p-2">
                                    <label for="bio">Bio</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <textarea class="form-control" id="bio" name="bio" rows="4" required value="{{$user->bio}}"></textarea>
                                    </div>
                                </div>
                                <div class="col-4 p-2">
                                    <label for="linkedln">Linkedln</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="linkedln" name="linkedln" placeholder="https://www.linkedin.com/" required value="{{$user->linkedln}}">
                                    </div>
                                </div>  
                                <div class="col-4 p-2">
                                    <a class="btn border-dark form-control" href="{{ route('professional.home') }}">Back</a>
                                </div>
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
