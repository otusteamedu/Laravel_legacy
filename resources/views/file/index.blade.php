@extends('front.main')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <input name="file" type="file" class="form-control" id="name" placeholder="File">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection()



