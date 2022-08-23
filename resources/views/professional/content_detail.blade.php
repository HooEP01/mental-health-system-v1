<script>
    function add()
    {
        let contentID = document.getElementById("content_id").value;
        let content = <?php echo json_encode($contents); ?>;
        content_id.setAttribute("value", content['contents']['id']);
    }
</script>

@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-6 p-0 m-0">
        @foreach($contents as $content)
        <div class="col-12 p-2">
            <div class="card">
                <div class="card-body">
                    <h4><span class="badge bg-primary">{{$content->category}} </span> <span class="badge bg-secondary"> {{$content->type}}</span></h4>
                    <input type="hidden" id="id" name="id" value="{{ $content->id }}">
                    <img src="{{ asset('content/')}}/{{ $content->image }}" alt="123" class="img-fluid rounded">
                    <h2 class="pt-3 pb-2">{{ $content->title}}</h2>
                    <p>{{ $content->summary}}</p>
                    <a class="btn btn-primary" href="{{route('professional.content_detail.view',['id'=>$content->id])}}">More</a>               
                </div>
            </div>
        </div>
        @endforeach
        </div>

        <div class="col-lg-6 p-0 m-0">
        @foreach($content_details as $content_detail)
        <div class="col-12 p-2">
            <div class="card p-4">
                <div class="card-body">
                    <div class="row">
                        <img src="{{ asset('content_detail/')}}/{{ $content_detail->image }}" alt="" class="img-fluid rounded">
                        
                        <?php if($content_detail->image == ''){

                        } else { ?>

                        <div class="col-12 p-2">
                            <audio controls>
                                <source src="{{ asset('content_detail_audio/')}}/{{ $content_detail->audio }}" type="audio/mpeg" alt="1234">
                            </audio>
                        </div>
                        
                        <?php } ?>
                        
                        <div class="col-12 p-2">
                            <h2 class="pt-3 pb-2">{{ $content_detail->subtitle}}</h2>
                        </div>

                        <div class="col-12 p-2">
                            <p>{{ $content_detail->description}}</p>
                        </div>
                        
                        

                        <?php $type = $content_detail->type;
                            if($type == 'short'){
                        ?>
                            <div class="col-4 p-2">
                                <label for="title">Short Answer</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="answer" name="answer" placeholder="" required>
                                </div>
                            </div> 
                        <?php 
                            }
                        ?>

                        <div class="col-2 p-2">
                            <a class="btn btn-danger" href="{{route('professional.content_detail.delete',['id'=> $content_detail->id])}}">Delete</a> 
                        </div>

                    </div>              
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-md-12 p-2">
            <div class="card">
                <div class="card-header">Content</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- form -->
                    <form action="{{route('professional.content_detail.add')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <input type="hidden" id="content_id" name="content_id" value="1">        
                        <div class="row">
                            <div class="col-4 p-2">
                                <label for="type">Type</label>
                            </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="no">None</option>
                                            <option value="short">Short Answer</option>
                                            <option value="paragraph">Paragraph</option>
                                            <option value="multiple">Multiple Choice</option>
                                            <option value="checkbox">Checkbox</option>
                                            <option value="file">File Upload</option>
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
                                        <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="" required>
                                    </div>
                                    <small class="text-danger">Required</small>
                                </div>  

                                <div class="col-4 p-2">
                                    <label for="description">Description</label>
                                </div>
                                <div class="col-8 p-2">
                                    <div class="form-group">
                                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                    </div>
                                </div>   

                                <div class="col-4 p-2">
                                    
                                </div>
                                <div class="col-8 p-2">
                                    <button type="submit" class="form-control" onclick="add()">Add</button>
                                </div>
                                
                        </form>
                        <!--/ form -->

                    </div>
                </div>
            </div>
        </div>

        </div>

    </div>
</div>
@endsection
