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
                <h1>@lang('auth.signing_in')</h1>
                {!! Form::open(array('route' => 'login', 'method' => 'post')) !!}
                <div class="form-group">
                    {!! Form::label('Email'); !!}
                    {!! Form::text('email', '', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                </div>
                <div class="form-group">
                    {!! Form::label(__('auth.password')); !!}
                    {!! Form::password('password', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                </div>
                <div class="form-group">
                    {!! Form::submit(__('auth.sign_in'), ['class' => 'btn btn-primary', 'aria-describedby' => '']); !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
