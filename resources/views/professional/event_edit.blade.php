@extends('layouts.auth')
@section('content')
<div class="container pt-3">
    <div class="row">
        @foreach($events as $event)
        <!-- title -->
        <div class="col-md-10 p-2">
            @if($event->type == 'Individual Counselling')
            <h5 class="fw-bold">Edit Individual Event</h5>
            @else
            <h5 class="fw-bold">Edit Group Event</h5>
            @endif
        </div>
        <!-- back button -->
        <div class="col-md-2 p-2 d-grid">
            <a class="btn btn-dark" href="{{route('professional.event.view')}}">< Back</a>
        </div>

        <div class="col-md-12 p-2"> 
            <div class="card">
                <div class="card-body">
                    <!-- form -->
                    <form action="{{route('professional.event.update')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <input type="hidden" id="event_id" name="event_id" value="{{$event->id}}"> 
                        <input type="hidden" id="professional_id" name="professional_id" value="{{ Auth::id() }}">
                               
                        <div class="row">
                            @if($event->type == 'Individual Counselling')
                            <!-- type -->
                            <input type="hidden" id="type" name="type" value="{{$event->type}}">  
                            <!-- Attendance Quantity -->
                            <input type="hidden" id="attendance_quantity" name="attendance_quantity" value="1">

                            @else
                            <!-- type -->
                            <div class="col-4 p-2">
                                <label for="type">Type</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="Group Counselling">Group Counselling</option>
                                        <option value="Seminar">Seminar</option>
                                    </select>
                                </div>
                            </div>  
                            <!-- Attendance Quantity -->
                            <div class="col-4 p-2">
                                <label for="attendance_quantity">Attendance Quality</label>
                            </div>  
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="attendance_quantity" name="attendance_quantity" placeholder="" required>
                                </div>
                            </div>  
                            @endif
                            <!-- amount -->
                            <div class="col-4 p-2">
                                <label for="amount">Amount</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="" value="{{$event->amount}}" required>
                                </div>
                            </div>  
                            <!-- Image -->
                            <div class="col-4 p-2">
                                <label for="image">Image</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="image" name="image" placeholder="" required>
                                </div>
                            </div>  
                            <!-- Title -->
                            <div class="col-4 p-2">
                                <label for="title">Title</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{$event->title}}" required>
                                </div>
                            </div>  
                            <!-- Summary -->
                            <div class="col-4 p-2">
                                <label for="description">Description</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <textarea class="form-control summernote" id="description" name="description" rows="5" required value="{{$event->description}}"></textarea>
                                </div>
                            </div>   
                            <!-- submit button -->
                            <div class="col-4 p-2"></div>
                            <div class="col-8 p-2">
                                <button type="submit" class="btn btn-primary form-control">Update</button>
                            </div>
                        </div>    
                    </form>
                    <!--/ form -->
                </div>
            </div>
        </div>
        @endforeach
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