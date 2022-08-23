@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 p-0 m-0">

        <div class="col-md-12 p-2">
            <div class="card">
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- form -->
                    <form action="{{route('professional.content.add')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <input type="hidden" id="professional_id" name="professional_id" value="{{ Auth::id() }}">        
                        <div class="row">
                            <div class="col-12 p-2">
                                <h5 class="fw-bold">MyContent</h5>
                            </div>
                            <div class="col-4 p-2">
                                <label for="type">Type</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="article">Article</option>
                                        <option value="questionaire">Questionaire</option>
                                        <option value="jornal">Guided Jornal</option>
                                    </select>
                                </div>
                            </div>  

                            <div class="col-4 p-2">
                                <label for="category">Category</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <select name="category" id="category" class="form-control" required>
                                        <option value="anxiety">Anxiety</option>
                                        <option value="relationship">Relationship</option>
                                        <option value="financial">Financial</option>
                                    </select>
                                </div>
                            </div> 

                            <div class="col-4 p-2">
                                <label for="image">Image</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="image" name="image" placeholder="" required>
                                    <small class="text-primary">500x500</small>
                                </div>
                            </div>  

                            <div class="col-4 p-2">
                                <label for="title">Title</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                                </div>
                            </div>  

                            <div class="col-4 p-2">
                                <label for="summary">Summary</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <textarea class="form-control" id="summary" name="summary" rows="4" required></textarea>
                                </div>
                            </div>   

                            <div class="col-4 p-2">
                                
                            </div>
                            <div class="col-8 p-2">
                                <button type="submit" class="btn btn-outline-primary form-control">Add</button>
                            </div>
                        </div>    
                    </form>
                    <!--/ form -->

                </div>
            </div>
        </div>

        </div>

        <div class="col-md-6 p-0 m-0">
        @foreach($contents as $content)
        <div class="col-md-12 p-2">
            <div class="card">
                <img src="{{ asset('content/')}}/{{ $content->image }}" alt="" class="img-fluid rounded card-img-top">
                <div class="card-body">
                    <input type="hidden" id="id" name="id" value="{{ $content->id }}">
                    <h2 class="pt-3 pb-2">{{ $content->title}} <span class="badge bg-primary">{{$content->category}}</span> <span class="badge bg-success"> {{$content->type}}</span></h2>
                    <p>{{ $content->summary}}</p>
                    <a class="btn btn-primary" href="{{route('professional.content_detail.view',['id'=>$content->id])}}">Add More</a>  
                    <a class="btn btn-danger float-end" href="{{route('professional.content_detail.view',['id'=>$content->id])}}">Delete</a>              
                </div>
            </div>
        </div>
        @endforeach
        </div>

    </div>
</div>
@endsection
