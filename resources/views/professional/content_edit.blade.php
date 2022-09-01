@extends('layouts.auth')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 p-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @foreach($contents as $content)
                    <!-- form -->
                    <form action="{{route('professional.content.update')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <!-- Professional_id -->
                        <input type="hidden" id="id" name="id" value="{{ $content->id }}">
                        <input type="hidden" id="professional_id" name="professional_id" value="{{ Auth::id() }}">        
                        <div class="row">
                            <div class="col-12 p-2">
                                <h5 class="fw-bold">Edit MyContent</h5>
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
                                    <select name="category" id="category" class="form-control" required>
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
                                    <small class="text-primary">500x500</small>
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
                                    <textarea class="form-control" id="summary" name="summary" rows="4" required value="{{ $content->summary }}"></textarea>
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
