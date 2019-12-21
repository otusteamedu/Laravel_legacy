@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <h1>Add new Location</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ Form::open([
            'url' => route('backend.location.store')
        ]) }}
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('distance', 'Distance') }}
                    {{ Form::text('distance', null, array('class'=>'form-control')) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
        </div>
        {{ Form::close() }}

    </div>
@endsection
