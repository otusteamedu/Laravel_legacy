@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <h1>Edit Location <em>{{ $location->name }}</em></h1>

        {{ Form::model($location, [
            'url' => route('backend.location.update', ['location' => $location]),
            'method' => 'patch'
        ]) }}
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', $location->name, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('distance', 'Distance') }}
                    {{ Form::text('distance', $location->distance, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('user_id', 'User') }}
                    {{ Form::select('user_id', $users, $location->user_id, array('class'=>'form-control')) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
        </div>
        {{ Form::close() }}

    </div>
@endsection
