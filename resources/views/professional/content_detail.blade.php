@extends('layouts.auth')
@section('content')
<div class="container pt-3">
    <div class="row">
        @foreach($contents as $content)
        <div class="col-md-9 p-2">
            <h2 class="pb-2">{{ $content->title}}</h2>
            <div>{!! $content->summary!!}</div>
            <p>By {{ $content->professional_id}}  |  {{ $content->updated_at}} | <span class="badge bg-success"> {{$content->type}}</span> <span class="badge bg-primary"> {{$content->category}} </span> </p>
            <input type="hidden" id="id" name="id" value="{{ $content->id }}">
            <div>
                <img src="{{ asset('content/')}}/{{ $content->image }}" alt="123" class="img-fluid d-block rounded" style="height:500px; weight:400px;">
            </div>
        </div>
        <div class="col-md-3 p-2 ps-4 pt-3">
            <div class="d-grid gap-3 mx-auto">
                <a class="btn btn-outline-dark" href="{{route('professional.content.view')}}">< Back</a>
                <a class="btn btn-outline-primary" href="{{route('professional.content.edit',['id'=>$content->id])}}">Edit Content</a> 
                <a class="btn btn-outline-danger" onclick="swal('{{ $content->id }}');" >Delete Content</a>           
            </div>
        </div>
        @endforeach
  
        @php
            $count = 1;
        @endphp
        @foreach($content_details as $content_detail)
        <div class="col-md-9 p-2">
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
                <div class="col-md-2">
                    <label for="title" class="form-label">Answer</label>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" class="form-control" id="answer" name="answer" placeholder="" required>
                    </div>
                </div> 
                @elseif($content_detail->type == 'Paragraph')
                <div class="col-md-2">
                    <label for="title" class="form-label">Answer</label>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <textarea class="form-control" id="answer" name="answer" rows="5"></textarea>
                    </div>
                </div> 
                @elseif($content_detail->type == 'File Upload')
                <div class="col-md-2">
                    <label for="title" class="form-label">Answer</label>
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="file" class="form-control" id="answer formFile" name="answer" placeholder="">
                    </div>
                </div> 
                @elseif($content_detail->type == 'Multiple Choice')
                <div class="col-md-2">
                    <label for="title" class="form-label">Answer</label>
                </div>
                <div class="col-md-10">
                @foreach($options as $option)
                @php
                    $content_detail_id = (string)$content_detail->id;
                    $option_id = $option->content_detail_id;
                @endphp
                @if( $content_detail_id == $option_id )
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$option->id}}" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{$option->description}}
                        </label>
                    </div>
                @endif
                @endforeach
                </div>
                @elseif($content_detail->type == 'Checkbox')
                <div class="col-md-2">
                    <label for="title" class="form-label">Answer</label>
                </div>
                <div class="col-md-10">
                @foreach($options as $option)
                @php
                    $content_detail_id = (string)$content_detail->id;
                    $option_id = $option->content_detail_id;
                    $check = 1;
                @endphp
                @if( $content_detail_id == $option_id )
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="{{ $content_detail_id }}" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            {{$option->description}}
                        </label>
                    </div>
                @php
                    $check++;
                @endphp
                @endif
                @endforeach
                </div>
                @endif
            </div>
        </div>               
        <div class="col-md-3 p-2 ps-4 pt-3">
            <div class="d-grid gap-3 mx-auto">
                <h5>{{ $count }} :</h5>
                <a class="btn btn-outline-primary" href="{{route('professional.content_detail.edit',['id'=> $content_detail->id])}}">Edit Detail</a>
                <a class="btn btn-outline-danger" onclick="swalDetail('{{ $content_detail->id }}');" >Delete Content</a>     
            </div>
        </div>
        @php
            $count++;
        @endphp
        @endforeach

        <div class="col-md-9 p-2">
            <div id="add" class="card">
                <div class="card-body">
                    <!-- form -->
                    <form action="{{route('professional.content_detail.add')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                        @CSRF
                        @foreach($contents as $content)
                        <input type="hidden" id="content_id" name="content_id" value="{{$content->id}}">     
                        @endforeach   
                        <div class="row">
                            <div class="col-md-2 p-2">
                                <label for="type" class="form-label">Type</label>
                            </div>
                            <div class="col-md-10 p-2">
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
                            </div>  
                            <div class="col-md-2 p-2">
                                <label for="image" class="form-label">Image</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="image" name="image" placeholder="">
                                </div>
                            </div>  
                            <div class="col-md-2 p-2">
                                <label for="audio" class="form-label">Audio</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="audio" name="audio" placeholder="">
                                </div>
                            </div> 
                            <div class="col-md-2 p-2">
                                <label for="subtitle" class="form-label">SubTitle</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="">
                                </div>            
                            </div>  
                            <div class="col-md-2 p-2">
                                <label for="description" class="form-label">Description</label>
                            </div>
                            <div class="col-md-10 p-2">
                                <div class="form-group">
                                    <textarea class="form-control summernote" id="description" name="description" rows="15"></textarea>
                                </div>
                                <small class="text-danger">Required</small>
                            </div>                           
                            <div id="optionTitle" class="col-md-2 p-2">
                                <label for="description" class="form-label">Option</label>
                            </div>
                            <div id="optionMain" class="col-md-10 p-2">
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
                            <div class="col-md-2 p-2"></div>
                            <div class="col-md-10 p-2">
                                <button type="submit" class="form-control">Add</button>
                            </div>     
                        </div>                   
                    </form>
                    <!--/ form -->
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2 ps-4 pt-3">
            <div class="d-grid gap-3 mx-auto">
                <button class="btn btn-outline-primary" onclick="addButton()">+ Content Detail</button>
            </div>
        </div>
    </div>
</div>
@endsection



<style>
    #add{
        display:none;
    }
    #optionMain{
        display:none;
    }
    #optionTitle{
        display:none;
    }
</style>



<!-- include libraries(jQuery, bootstrap) -->
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    function swal(id)
    {
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                new function() {
                window.location.href = "{{route('professional.content.delete', '')}}"+"/"+id;
                };
            }
        })
    }

    function swalDetail(id)
    {
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                new function() {
                window.location.href = "{{route('professional.content_detail.delete', '')}}"+"/"+id;
                };
            }
        })
    }

    function addButton() 
    {
        let add = document.getElementById("add");
        add.style.display = (add.style.display == "none")? "block" : "none";
    }

    const listOption = [];

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
