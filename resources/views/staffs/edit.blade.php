@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        {!! Form::open( ['route' => ['staffs.update', 'staff' => $staff->id], 'method' => 'PATCH']) !!}
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', __('staffs/edit.form.name.label')) !!}
                {!! Form::text('name', $staff->name, ['class' => 'form-control', 'placeholder' => __('staffs/edit.form.name.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', __('staffs/edit.form.email.label')) !!}
                {!! Form::email('email', $staff->email, ['class' => 'form-control', 'placeholder' => __('staffs/edit.form.email.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_old', __('staffs/edit.form.password.old.label')) !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('staffs/edit.form.password.old.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', __('staffs/edit.form.password.label')) !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('staffs/edit.form.password.placeholder')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_confirmation', __('staffs/edit.form.password.check.label')) !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('staffs/edit.form.password.check.placeholder')]) !!}
            </div>
        </div>
        <div class="card-footer">
            {!! Form::hidden('id', $client->id) !!}
            {!! Form::submit(__('staffs/edit.form.submit'), ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
