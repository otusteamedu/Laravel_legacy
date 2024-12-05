@extends('front.main')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($data as $news)
                <div class="col-md-6">
                    <p>{{$news->title}}</p>
                    <p>{{$news->description}}</p>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection()



