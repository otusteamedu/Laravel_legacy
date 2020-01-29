@extends('front.main')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('write')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter email">
                </div>
                <div class="form-group">
                    <input name="age" type="text" class="form-control" id="age" placeholder="Age">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection()



