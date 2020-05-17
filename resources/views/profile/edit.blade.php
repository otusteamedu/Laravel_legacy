@extends('layouts.general')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card profile">
        {!! Form::open() !!}
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-4 col-sm-3 col-lg-2 text-center">
                    <div class="form-group">
                        <img src="/{{ $user['image'] }}" alt="{{ $user['name'] }}" class="rounded profile-img">
                    </div>
                    <div class="form-group">
                        {!! Form::file('image') !!}
                    </div>
                </div>
                <div class="col-8 col-sm-9 col-lg-10">
                    <div class="form-group">
                        {!! Form::label('name', __('profile/edit.form.name.label')) !!}
                        {!! Form::text('name', $user['name'], ['class' => 'form-control', 'placeholder' => __('profile/edit.form.name.placeholder')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', __('profile/edit.form.email.label')) !!}
                        {!! Form::email('email', $user['email'], ['class' => 'form-control', 'placeholder' => __('profile/edit.form.email.placeholder')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_old', __('profile/edit.form.password.old.label')) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('profile/edit.form.password.old.placeholder')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', __('profile/edit.form.password.label')) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('profile/edit.form.password.placeholder')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_check', __('profile/edit.form.password.check.label')) !!}
                        {!! Form::password('password_check', ['class' => 'form-control', 'placeholder' => __('profile/edit.form.password.check.placeholder')]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {!! Form::submit(__('profile/edit.form.submit'), ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
