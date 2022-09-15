@extends('layouts.auth')
@section('content')
<div class="container pt-3">
    <div class="row mt-md-2 mb-md-3">
        <!-- title -->
        <div class="col-md-10 p-2">
            <h5 class="fw-bold ps-1">Profile</h5>
        </div>          
        <!-- back button -->
        <div class="col-md-2 p-2 d-grid">
            <a class="btn btn-dark" href="{{route('professional.home')}}">< Back</a>
        </div>  
        <div class="col-md-8 p-2">
            <div class="card">
                <div class="card-body">
                    @foreach($users as $user)
                    <!-- form -->
                    <form action="{{route('professional.profile.update')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <!-- Professional id -->
                        <input type="hidden" id="id" name="id" value="{{$user->id}}">
                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-2 p-2">
                                <label for="title" class="form-label">Title</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="title" required value="{{$user->title}}">
                                </div>
                            </div>   
                            <!-- Image -->
                            <div class="col-md-2 p-2">
                                <label for="image" class="form-label">Picture</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="image" name="image" placeholder="image">
                                </div>
                            </div>   
                            <!-- Bio -->
                            <div class="col-md-2 p-2">
                                <label for="bio" class="form-label">Bio</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <textarea class="form-control summernote" id="bio" name="bio" rows="4" required value="{{$user->bio}}"></textarea>
                                </div>
                            </div>
                            <!-- Linkedln -->
                            <div class="col-md-2 p-2">
                                <label for="linkedln" class="form-label">Linkedln</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="linkedln" name="linkedln" placeholder="https://www.linkedin.com/" value="{{$user->linkedln}}" required>
                                </div>
                            </div>  
                            <div class="col-md-2 p-2"></div>
                            <!-- Save Btn -->
                            <div class="col-md-10 p-2">
                                <button type="submit" class="btn btn-primary form-control">Save Change</button>
                            </div>
                        </div>
                    </form>
                    <!--/ form -->
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Profile view -->
        <div class="col-md-4 p-2">
            <div class="card">
                <div class="card-body">
                    @foreach($users as $user)
                    <p><img src="{{ asset('profile/')}}/{{ $user->image }}" class="rounded-circle mx-auto d-block" alt="..."></p>
                    <p class="text-center">{{$user->title}}, {{$user->name}}</p>
                    {!!$user->bio!!} <br>
                    <p>Linkedln: {{$user->linkedln}}</p>
                    @endforeach
                </div>
            </div>
        </div>
    
    </div>

</div>
@endsection





<!-- include libraries(jQuery, bootstrap) -->
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $('.summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>