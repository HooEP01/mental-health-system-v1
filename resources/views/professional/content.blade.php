@extends('layouts.auth')
@section('content')
<div class="cointainer-fluid bg-white">
    <div class="container">
        <!-- header nav -->
        <ul class="nav">
            <!-- My Content page -->
            <li class="nav-item">
                <a class="nav-link active ps-0" aria-current="page" href="{{route('professional.content.view')}}">My Content</a>
            </li>
            <!-- Community Content page -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('professional.content.community.view')}}">Community Content</a>
            </li>
        </ul>
    </div>
</div>
<div class="container pt-3">
    <div class="row">
        <div class="col-md-12 p-0 ps-3 pe-3">
            <div class="row">
                <div class="col-md-2 p-1">
                    <a class="btn btn-outline-primary form-control" href="{{ route('professional.content.add') }}">+ Content</a>
                </div>
                <div class="col-md-2 p-2"></div>
                <div class="col-md-4 p-1 d-grid">
                    <!-- search function -->
                    <form action="{{route('professional.content.search')}}" method="POST">
                        @csrf
                        <div><input type="search" id="name" name="name" class="form-control " placeholder="Search"></div>
                    </form>
                </div>
                <div class="col-md-4 p-1 d-grid">
                    <!-- filter function -->
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
                                <button type="submit" class="btn btn-outline-dark form-control">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach($contents as $content)
        <div class="col-md-4 p-2">
            <div class="card">
                <!-- image -->
                @php
                    $image = '1280x720.png';
                @endphp
                <img src="{{ asset('content/')}}/{{ $content->image }}" alt="{{ asset('content/')}}/{{$image}}" class="img-fluid rounded card-img-top">
                <div class="card-body">
                    <!-- content id -->
                    <input type="hidden" id="id" name="id" value="{{ $content->id }}">
                    <!-- title & category -->
                    <h2 class="pt-3 pb-2"> {{ $content->title }} </h2>
                    <!-- summary -->
                    <div style="height:100px;"> {!! $content->summary !!} </div>
                    <!-- Updated_at + type + category -->
                    <p> <small> {{ $content->updated_at}}</small> <br> <span class="badge bg-success"> {{$content->type}}</span> <span class="badge bg-primary"> {{$content->category}} </span> </p>
                    <!-- Add more btn (redirect to content detail page) -->
                    <a class="btn btn-outline-primary" href="{{route('professional.content_detail.view',['id'=>$content->id])}}">View Content</a>  
                    <!-- delete btn -->
                    <a class="btn btn-outline-danger float-end" onclick="swal('{{ $content->id }}');" >Delete Content</a>              
                </div>
            </div>      
        </div>
        @endforeach
        <div class="col-md-12 p-2 d-flex">
            {{ $contents->links() }} 
        </div>
    </div>
</div>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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

    let app = {{ Js::from($contents) }};
    console.log(app);
</script>
