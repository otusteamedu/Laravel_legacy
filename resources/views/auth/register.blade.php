@extends('layouts.main.index')

@section('content')
    <div class="container">
        <div class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-8 offset-md-2">
                <h1>@lang('auth.sign_up')</h1>
                {!! Form::open(array('route' => 'register', 'method' => 'post')) !!}
                <div class="form-group">
                    {!! Form::label(__('auth.user_name')); !!}
                    {!! Form::text('name', '', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Email'); !!}
                    {!! Form::text('email', '', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                </div>
                <div class="form-group">
                    {!! Form::label(__('auth.password')); !!}
                    {!! Form::password('password', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                </div>
                <div class="form-group">
                    {!! Form::label(__('auth.password_confirmation')); !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                </div>
                <div class="form-group">
                    {!! Form::submit(__('auth.to_register'), ['class' => 'btn btn-primary', 'aria-describedby' => '']); !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
