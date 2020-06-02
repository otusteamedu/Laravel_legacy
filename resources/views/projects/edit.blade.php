@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        {!! Form::open( ['route' => ['projects.update', 'project' => $project->id], 'method' => 'PATCH']) !!}
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', __('projects/edit.form.name.label')) !!}
                {!! Form::text('name', $project->name, ['class' => 'form-control', 'placeholder' => __('projects/edit.form.name.placeholder')]) !!}
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit(__('projects/edit.form.submit'), ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
