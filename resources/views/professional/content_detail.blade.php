<style>
    #add{
        /* display:none (disappear) */
        display:none;
    }

    #option{
        display: none;
    }
    #optionTitle{
        display:none;
    }
</style>

<script>
    let option = <?php echo json_encode($options); ?>;
    console.log(option);

    function addButton () 
    {
        let add = document.getElementById("add");

        if(add.style.display == "none")
        {
            add.style.display = "block";
        }
        else
        {
            add.style.display = "none";
        }
    }

    function optionType()
    {
        let type = document.getElementById("type").value;

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

        <div class="col-md-2"></div>
       
        <div class="col-10 p-2">

            <div class="row">
            @foreach($contents as $content)
            <div class="col-10 p-2">
                <h2 class="pt-3 pb-2">{{ $content->title}}</h2>
                <p>{{ $content->summary}}</p>
                <p>By {{ $content->professional_id}}  |  {{ $content->updated_at}} | <span class="badge bg-success"> {{$content->type}}</span> <span class="badge bg-primary"> {{$content->category}} </span> </p>
                <input type="hidden" id="id" name="id" value="{{ $content->id }}">
                <img src="{{ asset('content/')}}/{{ $content->image }}" alt="123" class=" mx-auto d-block rounded" style=" height:500px; weight:400px;">
                
                
            </div>
            <div class="col-2 p-3 border-bottom">
                <a class="btn btn-outline-primary" href="{{route('professional.content.edit',['id'=>$content->id])}}" style="width:150px">Edit Content</a>  
            </div>
            @endforeach
            </div>

            <div class="row">
            @foreach($content_details as $content_detail)
            <div class="col-10 p-2">
                <!-- image -->
                <img src="{{ asset('content_detail/')}}/{{ $content_detail->image }}" alt="" class="img-fluid rounded">
                <!-- audio -->
                @if(!($content_detail->audio == ''))
                <audio controls>
                    <source src="{{ asset('content_detail_audio/')}}/{{ $content_detail->audio }}" type="audio/mpeg" alt="">
                </audio>
                @endif
                <!-- subtitle -->
                @if(!($content_detail->subtitle == ''))
                <h2 class="pt-3 pb-2">{{ $content_detail->subtitle }}</h2>
                @endif
                <!-- description -->
                @if(!($content_detail->description == ''))
                <div>{!! $content_detail->description !!}</div>
                @endif

                <div class="row">
                    @if($content_detail->type == 'Short Answer')      
                    <div class="col-4">
                        <label for="title">Short Answer</label>
                    </div>
                    <div class="col-8 p-2">
                        <div class="form-group">
                            <input type="text" class="form-control" id="answer" name="answer" placeholder="" required>
                        </div>
                    </div> 
                    @elseif($content_detail->type == 'Paragraph')
                    <div class="col-4">
                        <label for="title">Paragraph</label>
                    </div>
                    <div class="col-8 p-2">
                        <div class="form-group">
                            <textarea class="form-control" id="answer" name="answer" rows="4"></textarea>
                        </div>
                    </div> 
                    @elseif($content_detail->type == 'File Upload')
                    <div class="col-4">
                        <label for="title">File Upload</label>
                    </div>
                    <div class="col-8 p-2">
                        <div class="form-group">
                            <input type="file" class="form-control" id="answer" name="answer" placeholder="">
                        </div>
                    </div> 
                    @elseif($content_detail->type == 'Multiple Choice')
                    <div class="col-4">
                        <label for="title">Multiple Choice</label>
                    </div>
                    <div class="col-8 p-2">
                        <select name="answer" id="answer" class="form-select" multiple>
                            @foreach($options as $opt)
                            <option value="{{$opt->id}}">{{$opt->description}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
            </div>               

            <div class="col-2 p-3 border-bottom">
                <a class="btn btn-outline-primary mb-2" href="{{route('professional.content_detail.edit',['id'=> $content_detail->id])}}" style="width:150px">Edit Detail</a> 
                <a class="btn btn-danger" href="{{route('professional.content_detail.delete',['id'=> $content_detail->id])}}" style="width:150px">Delete</a> 
            </div>
            @endforeach
            </div>

            <div class="row">
                <div class="col-10 p-2">
                <div id="add" class="card">
                <div class="card-body">
                <!-- form -->
                <form action="{{route('professional.content_detail.add')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                        @CSRF
                            @foreach($contents as $content)
                            <input type="hidden" id="content_id" name="content_id" value="{{$content->id}}">     
                            @endforeach   
                            <div class="row">
                                <div class="col-4 p-2">
                                    <label for="type">Type</label>
                                </div>
                                    <div class="col-8 p-2">
                                        <div class="form-group">
                                            <select name="type" id="type" class="form-select" onchange="optionType()" required>
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

                                    <div class="col-4 p-2">
                                        <label for="image">Image</label>
                                    </div>
                                    <div class="col-8 p-2">
                                        <div class="form-group">
                                            <input type="file" class="form-control" id="image" name="image" placeholder="">
                                        </div>
                                    </div>  

                                    <div class="col-4 p-2">
                                        <label for="image">Audio</label>
                                    </div>
                                    <div class="col-8 p-2">
                                        <div class="form-group">
                                            <input type="file" class="form-control" id="audio" name="audio" placeholder="">
                                        </div>
                                    </div> 

                                    <div class="col-4 p-2">
                                        <label for="subtitle">SubTitle</label>
                                    </div>
                                    <div class="col-8 p-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="">
                                        </div>
                                        
                                    </div>  

                                    <div class="col-4 p-2">
                                        <label for="description">Description</label>
                                    </div>
                                    <div class="col-8 p-2">
                                        <div class="form-group">
                                            <textarea class="form-control summernote" id="description" name="description" rows="15"></textarea>
                                        </div>
                                        <small class="text-danger">Required</small>
                                    </div>   
                                    
                                    <div id="optionTitle" class="col-4 p-2">
                                        <label for="description">Option</label>
                                    </div>
                                    <div id="option" class="col-8 p-2">
                                        
                                    </div>  

                                    <div class="col-4 p-2">
                                        
                                    </div>
                                    <div class="col-8 p-2">
                                        <button type="submit" class="form-control">Add</button>
                                    </div>
                                    
                </form>
                <!--/ form -->
                </div>
            </div>
        
        </div>

                </div>

                <div class="col-2 p-3">
                    <button class="btn btn-outline-primary" onclick="addButton()" style="width:150px">Add Content Detail</button>
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
