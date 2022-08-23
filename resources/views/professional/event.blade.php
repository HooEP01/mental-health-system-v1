

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
                    <form action="{{route('professional.event.add')}}" method="POST" enctype="multipart/form-data" class="validate-form mt-2" novalidate="novalidate">
                    @CSRF
                        <input type="hidden" id="professional_id" name="professional_id" value="{{ Auth::id() }}">        
                        <div class="row">
                            <div class="col-12 p-2">
                                <h5 class="fw-bold">Content</h5>
                            </div>
                            <div class="col-4 p-2">
                                <label for="type">Type</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="indi">Individual Counseling</option>
                                        <option value="group">Group Counseling</option>
                                        <option value="seminar">Seminar</option>
                                    </select>
                                </div>
                            </div>  

                            <div class="col-4 p-2">
                                <label for="attendance_quantity">Attendance Quality</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="attendance_quantity" name="attendance_quantity" placeholder="" required>
                                </div>
                            </div>
                            
                            <div class="col-4 p-2">
                                <label for="amount">Amount</label>
                            </div>
                            <div class="col-8 p-2">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="" required>
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
        @foreach($events as $event)
        <div class="col-md-12 p-2">
            <div class="card">
                
                
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" id="id" name="id" value="{{ $event->id }}">
                        <div class="col-12">
                            <img src="{{ asset('event/')}}/{{ $event->image }}" alt="" class="img-fluid rounded card-img-top">
                        </div>
                        <div class="col-12">
                            <h2 class="pt-3 pb-2">{{ $event->title }} <span class="badge bg-secondary"> {{$event->type }}</span></h2>
                            <p>{{ $event->description }}</p>
                        </div>
                        <div class="col-6">
                            <p>Attendance: {{ $event->attendance_quantity }}</p>  
                        </div>
                        <div class="col-6">
                            <p>Fee: {{ $event->amount }}</p>  
                        </div>
                        <div class="col-6">
                            Schedule:  Mon: 7 - 10 am
                        </div>    
     

                        <div class="col-12 pt-2">
                            <a class="btn btn-primary" href="{{route('professional.event.edit',['id'=>$event->id])}}">Edit</a>  
                            <a class="btn btn-danger float-end" href="{{route('professional.event.delete',['id'=>$event->id])}}">Delete</a>             
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        @endforeach
        </div>

    </div>
</div>
@endsection
