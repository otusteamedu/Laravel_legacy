@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        {!! Form::open( ['route' => ['projects.store'], 'method' => 'POST']) !!}
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', __('projects/create.form.name.label')) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('projects/create.form.name.placeholder')]) !!}
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit(__('projects/create.form.submit'), ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
