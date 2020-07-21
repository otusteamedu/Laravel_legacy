@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        {!! Form::open( ['route' => ['clients.store'], 'method' => 'POST']) !!}
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', __('clients/create.form.name.label')) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('clients/create.form.name.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', __('clients/create.form.email.label')) !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('clients/create.form.email.placeholder')]) !!}
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit(__('clients/create.form.submit'), ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
