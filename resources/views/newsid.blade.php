@extends('front.main')
@section('content')
    <div class="container">
        <div class="row">
                <div class="col-md-6">
                    <p>{{$data->title}}</p>
                    <p>{{$data->description}}</p>
                </div>
                <hr>
        </div>
    </div>
@endsection()



