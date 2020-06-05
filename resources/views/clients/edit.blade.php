@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        {!! Form::open( ['route' => ['clients.update', 'client' => $client->id], 'method' => 'PATCH']) !!}
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', __('clients/edit.form.name.label')) !!}
                {!! Form::text('name', $client->name, ['class' => 'form-control', 'placeholder' => __('clients/edit.form.name.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', __('clients/edit.form.email.label')) !!}
                {!! Form::email('email', $client->email, ['class' => 'form-control', 'placeholder' => __('clients/edit.form.email.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_old', __('clients/edit.form.password.old.label')) !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('clients/edit.form.password.old.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', __('clients/edit.form.password.label')) !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('clients/edit.form.password.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_confirmation', __('clients/edit.form.password.check.label')) !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('clients/edit.form.password.check.placeholder')]) !!}
            </div>
        </div>
        <div class="card-footer">
            {!! Form::hidden('id', $client->id) !!}
            {!! Form::submit(__('clients/edit.form.submit'), ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
