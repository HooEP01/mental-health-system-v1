@extends('layouts.auth')
@section('content')
<div class="container pt-3">
    <div class="row">
        <div class="col-md-10 p-2">
            @if($type == 'individual')
            <h5 class="fw-bold">Individual Event</h5>
            @else
            <h5 class="fw-bold">Group Event</h5>
            @endif
        </div>
        <div class="col-md-2 p-2 d-grid">
            <a class="btn btn-outline-dark" href="{{route('professional.event.view')}}">< Back</a>
        </div>

        <div class="col-md-12 p-2"> 
            <div class="card">
                <div class="card-body">
                    <!-- form -->
                    <form action="{{route('professional.event.create')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <input type="hidden" id="professional_id" name="professional_id" value="{{ Auth::id() }}">        
                        <div class="row">
                            
                            @if($type == 'individual')
                            <!-- type -->
                            <input type="hidden" id="type" name="type" value="Individual Counselling">  
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
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="" required>
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
                                    <input type="text" class="form-control" id="title" name="title" placeholder="" required>
                                </div>
                            </div>  
                            <!-- Summary -->
                            <div class="col-4 p-2">
                                <label for="summary">Summary</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <textarea class="form-control" id="summary" name="summary" rows="5" required></textarea>
                                </div>
                            </div>   
                            <!-- submit button -->
                            <div class="col-4 p-2"></div>
                            <div class="col-8 p-2">
                                <button type="submit" class="btn btn-outline-primary form-control">Create</button>
                            </div>
                        </div>    
                    </form>
                    <!--/ form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
