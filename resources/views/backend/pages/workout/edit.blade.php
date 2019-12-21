@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <h1>Edit Workout</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ Form::model($workout, [
            'url' => route('backend.workout.update', ['workout' => $workout]),
            'method' => 'patch'
        ]) }}
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', $workout->name, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('distance', 'Distance') }}
                    {{ Form::text('distance', $workout->distance, array('class'=>'form-control')) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('started_at', 'Started at') }}
                    {{ Form::text('started_at', $workout->started_at, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('duration', 'Duration. sec.') }}
                    {{ Form::text('duration', $workout->duration, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="form-group">
                    {{ Form::label('location_id', 'Location') }}
                    {{ Form::select('location_id', $locations, $workout->location_id, array('class'=>'form-control')) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
        </div>
        {{ Form::close() }}

        <div class="row">
            <div class="col"><hr></div>
        </div>

        <h2>Delete Workout</h2>

        {{ Form::model($workout, [
            'url' => route('backend.workout.destroy', ['workout' => $workout]),
            'method' => 'delete',
            'id'=>'form-delete'
        ]) }}
        <p>This action cannot be undone.</p>
        <div class="form-group">
            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
        </div>
        {{ Form::close() }}

    </div>
@endsection
