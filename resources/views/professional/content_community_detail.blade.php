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
                <a class="btn btn-outline-dark" href="{{route('professional.content.community.view')}}">< Back</a>
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
            
        </div>
        @php
            $count++;
        @endphp
        @endforeach
    </div>
</div>
@endsection
