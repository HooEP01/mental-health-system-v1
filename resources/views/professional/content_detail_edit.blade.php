
<script type="text/javascript">
    let v = <?php echo json_encode($options); ?>;
    console.log(v);

    let contentDetail = <?php echo json_encode($content_details); ?>;
    let currentType = contentDetail[0]["type"];
    if(currentType == "Multiple Choice" || currentType == "Checkbox")
        {
            option.style.display = "block";
            optionTitle.style.display = "block";

            option.innerHTML = `<input type="text" class="form-control mb-2" id="option1" name="option1" placeholder="">
                                <input type="text" class="form-control mb-2" id="option2" name="option2" placeholder="">
                                <input type="text" class="form-control mb-2" id="option3" name="option3" placeholder="">
                                <input type="text" class="form-control mb-2" id="option4" name="option4" placeholder="">`
        }
        else
        {
            option.style.display = "none";
            optionTitle.style.display = "none";
        }
    

    function optionType()
    {
        let type = document.getElementById("type").value;
        console.log(type);
        if(type == "Multiple Choice" || type == "Checkbox")
        {
            option.style.display = "block";
            optionTitle.style.display = "block";

            option.innerHTML = `<input type="text" class="form-control mb-2" id="option1" name="option1" placeholder="">
                                <input type="text" class="form-control mb-2" id="option2" name="option2" placeholder="">
                                <input type="text" class="form-control mb-2" id="option3" name="option3" placeholder="">
                                <input type="text" class="form-control mb-2" id="option4" name="option4" placeholder="">`
        }
        else
        {
            option.style.display = "none";
            optionTitle.style.display = "none";
        }
    }
</script>

@extends('layouts.auth')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 p-2"></div>
        <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @foreach($content_details as $content_detail)
                 <!-- form -->
                <form action="{{route('professional.content_detail.update')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                    <input type="hidden" id="id" name="id" value="{{ $content_detail->id }}">     
                    <div class="row">
                        <!-- type -->
                        <div class="col-4 p-2">
                            <label for="type">Type</label>
                        </div>
                        <div class="col-8 p-2">
                            <div class="form-group">
                                <select name="type" id="type" class="form-select" onchange="optionType()" required>
                                    <option value="{{ $content_detail->type }}" selected> {{ $content_detail->type }} </option>
                                    <option value="None">None</option>
                                    <option value="Short Answer">Short Answer</option>
                                    <option value="Paragraph">Paragraph</option>
                                    <option value="Multiple Choice">Multiple Choice</option>
                                    <option value="Checkbox">Checkbox</option>
                                    <option value="File Upload">File Upload</option>
                                </select>
                            </div>
                            <small class="text-danger">Required</small>
                        </div>  
                        <!-- image -->
                        <div class="col-4 p-2">
                            <label for="image">Image</label>
                        </div>
                        <div class="col-8 p-2">
                            <div class="form-group">
                                <input type="file" class="form-control" id="image" name="image" placeholder="">
                            </div>
                        </div>  
                        <!-- audio -->
                        <div class="col-4 p-2">
                            <label for="image">Audio</label>
                        </div>
                         <div class="col-8 p-2">
                            <div class="form-group">
                                <input type="file" class="form-control" id="audio" name="audio" placeholder="">
                            </div>
                        </div> 
                        <!-- subtitle -->
                        <div class="col-4 p-2">
                            <label for="subtitle">SubTitle</label>
                        </div>
                        <div class="col-8 p-2">
                            <div class="form-group">
                                <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="" value="{{ $content_detail->subtitle }}">
                            </div>
                        </div>  

                        <div class="col-4 p-2">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-8 p-2">
                            <div class="form-group">
                                <textarea class="form-control summernote" id="description" name="description" rows="15" value="{{ $content_detail->description }}"></textarea>
                            </div>
                            <small class="text-danger">Required</small>
                        </div>   
                        <!-- option -->   
                        <div id="optionTitle" class="col-4 p-2">
                            <label for="description">Option</label>
                        </div>
                        <div id="option" class="col-8 p-2"></div>  

                        <div class="col-4 p-2"></div>
   
                        <div class="col-8 p-2">
                            <button type="submit" class="form-control">Edit</button>
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
