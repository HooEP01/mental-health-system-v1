@extends('layouts.auth')
@section('content')
<div class="cointainer-fluid bg-white">
    <div class="container">
        <!-- header nav -->
        <ul class="nav">
            <!-- Event page -->
            <li class="nav-item">
                <a class="nav-link active ps-0" aria-current="page" href="{{route('professional.content.view')}}">My Content</a>
            </li>
            <!-- home page -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('professional.content.community.view')}}">Community Content</a>
            </li>
        </ul>
    </div>
</div>
<div class="container pt-3">
    <div class="row">
        <div class="col-md-10 p-2">
            <h5 class="fw-bold ps-1">Edit Content Detail</h5>
        </div>
        @foreach($content_details as $content_detail)
        <div class="col-md-2 p-2 d-grid">
            <a class="btn btn-outline-dark" href="{{route('professional.content_detail.view',['id'=>$content_detail->content_id])}}">< Back</a>
        </div>
        <div class="col-md-12 p-2">
        <div class="card">
            <div class="card-body">
                 <!-- form -->
                <form action="{{route('professional.content_detail.update')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                    <input type="hidden" id="id" name="id" value="{{ $content_detail->id }}">     
                    <div class="row">
                        <!-- type -->
                        <div class="col-4 p-2">
                            <label for="type" class="form-label">Type</label>
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
                        </div>  
                        <!-- image -->
                        <div class="col-4 p-2">
                            <label for="image" class="form-label">Image</label>
                        </div>
                        <div class="col-8 p-2">
                            <div class="form-group">
                                <input type="file" class="form-control" id="image" name="image" placeholder="">
                            </div>
                        </div>  
                        <!-- audio -->
                        <div class="col-4 p-2">
                            <label for="image" class="form-label">Audio</label>
                        </div>
                         <div class="col-8 p-2">
                            <div class="form-group">
                                <input type="file" class="form-control" id="audio" name="audio" placeholder="">
                            </div>
                        </div> 
                        <!-- subtitle -->
                        <div class="col-4 p-2">
                            <label for="subtitle" class="form-label">SubTitle</label>
                        </div>
                        <div class="col-8 p-2">
                            <div class="form-group">
                                <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="" value="{{ $content_detail->subtitle }}">
                            </div>
                        </div>  
                        <!-- description -->
                        <div class="col-4 p-2">
                            <label for="description" class="form-label">Description</label>
                        </div>
                        <div class="col-8 p-2">
                            <div class="form-group">
                                <textarea class="form-control summernote" id="description" name="description" rows="15" value="{{ $content_detail->description }}"></textarea>
                            </div>
                            <small class="text-danger">Required</small>
                        </div>   
                        <!-- option -->   
                        <div id="optionTitle" class="col-md-4 p-2">
                            <label for="description" class="form-label">Option</label>
                        </div>
                        <div id="optionMain" class="col-md-8 p-2">
                            <div class="row">
                                <div class="row list m-0 p-0" id="list"></div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control mb-2" id="option" name="option" placeholder="">
                                </div>
                                <div class="col-md-4 d-grid">
                                    <button type="button" id="addOptionBtn" class="btn btn-outline-dark">+ Option</button>
                                </div>
                            </div>
                        </div>  
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



<style>
    #optionMain{
        display:none;
    }
    #optionTitle{
        display:none;
    }
</style>



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

    let option = {{ Js::from($options) }};
    const listOption = option;

    $(document).ready(function() {
        if(listOption !== null){
            optionType();
            optionPrint();
        }
    });
    
    function optionType()
    {
        let type = document.getElementById("type").value;
        let option = document.getElementById("optionMain");
        let optionTitle = document.getElementById("optionTitle");
        if(type == "Multiple Choice" || type == "Checkbox"){
            option.style.display = "block";
            optionTitle.style.display = "block";
        }else{
            option.style.display = "none";
            optionTitle.style.display = "none";
        }
        let addOptionButton = document.getElementById('addOptionBtn');
        addOptionButton.addEventListener('click', function(item) {
            listOption.push({
                description: document.getElementById("option").value,
            })
            optionPrint();
            document.getElementById('option').value = "";
        })
    }

    function optionEdit(id)
    {
        optionContent = document.getElementById(id).value;
        listOption[id].description = optionContent;
        optionPrint();
    }

    function optionDelete(id)
    {
        let indexNo = parseInt(id);
        listOption.splice(indexNo, 1);
        optionPrint();
    }

    function optionPrint()
    {
        let htmlStr = '';
        let count = 0;
        let list = document.getElementById('list');
        listOption.forEach(function (item) {
            htmlStr = htmlStr + `
                <div class="col-md-8">
                    <input type="text" class="form-control mb-2" id="${count}" name="opt[]" value="${item.description}">
                </div>
                <div class="col-md-4">
                    <button type="button" onclick="optionEdit('${count}')" class="btn btn-outline-success" style="width:120px">Option Edit</button>
                    <button type="button" onclick="optionDelete('${count}')" class="btn btn-outline-danger" style="width:120px">Option Delete</button>
                </div>
            `;
            count++;
        })
        list.innerHTML = htmlStr;
    }

    

</script>
