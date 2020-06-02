@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        {!! Form::open( ['route' => ['staffs.store'], 'method' => 'POST']) !!}
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', __('staffs/create.form.name.label')) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('staffs/create.form.name.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', __('staffs/create.form.email.label')) !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('staffs/create.form.email.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', __('staffs/create.form.password.label')) !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('staffs/create.form.password.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_check', __('staffs/create.form.password.check.label')) !!}
                {!! Form::password('password_check', ['class' => 'form-control', 'placeholder' => __('staffs/create.form.password.check.placeholder')]) !!}
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit(__('staffs/create.form.submit'), ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
