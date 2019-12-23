@extends('backend.layouts.main')

@section('content')
    <div class="container">

        <h1>Edit Location</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
        </div>
        <div class="form-group">
            {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
        </div>
        {{ Form::close() }}

        <div class="row">
            <div class="col"><hr></div>
        </div>

        <h2>Delete Location</h2>

        {{ Form::model($location, [
            'url' => route('backend.location.destroy', ['location' => $location]),
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
