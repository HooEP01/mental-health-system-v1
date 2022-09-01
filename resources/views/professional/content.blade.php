<style>
    #add{
        /* display:none (disappear) */
        display:none;
    }
</style>

<script>
    let content = <?php echo json_encode($contents); ?>;
    console.log(content);

    function addButton () {
        let add = document.getElementById("add");

        if(add.style.display == "none"){
            add.style.display = "block";
        }else{
            add.style.display = "none";
        }
    }
</script>

@extends('layouts.auth')
@section('content')

<div class="cointainer-fluid bg-white">
    <div class="container">
        <!-- header nav -->
        <ul class="nav">
            <!-- Event page -->
            <li class="nav-item">
                <a class="nav-link active ps-0" aria-current="page" href="{{route('professional.event.view')}}">My Content</a>
            </li>
            <!-- home page -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('professional.home')}}">Community Content</a>
            </li>
        </ul>
    </div>
</div>

<div class="container pt-3">
    <div class="row">
        <div class="col-md-12 p-2">
            <div class="row">
                <div class="col-2">
                    <button class="btn btn-outline-primary" onclick="addButton()">+ Content</button>
                </div>
                <div class="col-2"></div>
                <div class="col-4">
                    <form action="{{route('professional.content.search')}}" method="POST">
                        @csrf
                        <div><input type="search" id="name" name="name" class="form-control " placeholder="search"></div>
                    </form>
                </div>
                <div class="col-4">
                    <form action="{{route('professional.content.filter')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <select id="filter" name="filter" class="form-select">
                                    <optgroup label="Type">
                                        <option value="Article">Article</option>
                                        <option value="Questionaire">Questionaire</option>
                                        <option value="Guided Jornal">Guided Jornal</option>
                                    </optgroup>
                                    <optgroup label="Category">
                                        <option value="Workplace">Workplace</option>
                                        <option value="Stress">Stress</option>
                                        <option value="Self-love">Self-love</option>
                                        <option value="Childcare">Childcare</option>
                                        <option value="Anxiety">Anxiety</option>
                                        <option value="Relationship">Relationship</option>
                                        <option value="Financial">Financial</option>
                                    </optgroup>
                                </select>
                            </div>
                            
                            <div class="col-4">
                                <button type="submit" class="btn btn-outline-secondary form-control">Filter</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
            
            

            <div id="add" class="card mt-3">
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- form -->
                    <form action="{{route('professional.content.add')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <!-- Professional_id -->
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
                                    <select name="category" id="category" class="form-control" required>
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
                                <input type="file" class="form-control" id="image" name="image" placeholder="" required>
                                    <small class="text-primary">500x500</small>
                                </div>
                            </div>  
                            <!-- Title -->
                            <div class="col-4 p-2">
                                <label for="title">Title</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                                </div>
                            </div>  
                            <!-- Summary -->
                            <div class="col-4 p-2">
                                <label for="summary">Summary</label>

                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                <textarea id="summary" class="form-control summernote" rows="15" name="summary" required></textarea>
                                </div>
                            </div>   
                            <div class="col-4 p-2"></div>
                            <div class="col-8 p-2">
                                <button type="submit" class="btn btn-outline-primary form-control">Save</button>
                            </div>
                        </div>    
                    </form>
                    <!--/ form -->

                </div>
            </div>
        </div>

        @foreach($contents as $content)
        <div class="col-md-4 p-2">
                <div class="card">
                    <!-- image -->
                    <img src="{{ asset('content/')}}/{{ $content->image }}" alt="" class="img-fluid rounded card-img-top" style="weight:300px; height:300px;">
                    <div class="card-body">
                        <!-- content id -->
                        <input type="hidden" id="id" name="id" value="{{ $content->id }}">
                        <!-- title & category -->
                        <h2 class="pt-3 pb-2"> {{ $content->title}} </h2>
                        <!-- summary -->
                        <p> {{ $content->summary}} </p>

                        <p> <small> {{ $content->updated_at}}</small> <br> <span class="badge bg-success"> {{$content->type}}</span> <span class="badge bg-primary"> {{$content->category}} </span> </p>

                        <!-- Add more btn (redirect to content detail page) -->
                        <a class="btn btn-outline-primary" href="{{route('professional.content_detail.view',['id'=>$content->id])}}">View Content</a>  
                        <!-- delete btn -->
                        <a class="btn btn-outline-danger float-end" href="{{route('professional.content.delete',['id'=>$content->id])}}">Delete Content</a>              
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