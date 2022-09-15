@extends('layouts.auth')
@section('content')
<div class="container">
    <div class="row pt-3">
        <div class="col-md-10 p-2">
            <h5 class="fw-bold ps-1">Edit Content</h5>
        </div>
        @foreach($contents as $content)
        <div class="col-md-2 p-2 d-grid">
            <a class="btn btn-outline-dark" href="{{route('professional.content_detail.view',['id'=> $content->id])}}">< Back</a>
        </div>
        <div class="col-md-12 p-2">
            <div class="card">
                <div class="card-body">
                    <!-- form -->
                    <form action="{{route('professional.content.update')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <!-- Professional_id -->
                        <input type="hidden" id="id" name="id" value="{{ $content->id }}">
                        <input type="hidden" id="professional_id" name="professional_id" value="{{ Auth::id() }}">        
                        <div class="row">
                            <div class="col-12 p-2">
                                <h5 class="fw-bold">MyContent</h5>
                            </div>
                            <!-- Type -->
                            <div class="col-4 p-2">
                                <label for="type">Type</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <select name="type" id="type" class="form-select" required>
                                        <option value="{{ $content->type }}" selected> {{ $content->type }} </option>
                                        <option value="Article">Article</option>
                                        <option value="Questionaire">Questionaire</option>
                                        <option value="Guided Jornal">Guided Jornal</option>
                                    </select>
                                </div>
                            </div>  
                            <!-- Category -->
                            <div class="col-4 p-2">
                                <label for="category">Category</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <select name="category" id="category" class="form-select" required>
                                        <option value="{{ $content->category }}" selected> {{ $content->category }} </option>
                                        <option value="Workplace">Workplace</option>
                                        <option value="Stress">Stress</option>
                                        <option value="Self-love">Self-love</option>
                                        <option value="Childcare">Childcare</option>
                                        <option value="Anxiety">Anxiety</option>
                                        <option value="Relationship">Relationship</option>
                                        <option value="Financial">Financial</option>
                                    </select>
                                </div>
                            </div> 
                            <!-- Image -->
                            <div class="col-4 p-2">
                                <label for="image">Image</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                <input type="file" class="form-control" id="image" name="image" placeholder="">
                                <small class="text-primary">Size: 1280x960, Type: .png .jpg .jpeg</small>
                                </div>
                            </div>  
                            <!-- Title -->
                            <div class="col-4 p-2">
                                <label for="title">Title</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="" required value="{{ $content->title }}">
                                </div>
                            </div>  
                            <!-- Summary -->
                            <div class="col-4 p-2">
                                <label for="summary">Summary</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <textarea class="form-control summernote" id="summary" name="summary" rows="4" required value="{{ $content->summary }}"></textarea>
                                </div>
                            </div>   
                            <div class="col-4 p-2"></div>
                            <div class="col-8 p-2">
                                <button type="submit" class="btn btn-outline-primary form-control">Update</button>
                            </div>
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



<!-- include libraries(jQuery, bootstrap) -->
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<!-- summernote -->
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
