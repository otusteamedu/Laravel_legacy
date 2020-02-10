@extends('layouts.main.index')

@section('content')
    <div class="container">
        <div class="content">
                <div class="col-md-8 offset-md-2">
                    <h1>Регистрация</h1>
                    {!! Form::open([]) !!}
                    <div class="form-group">
                        {!! Form::label('Имя'); !!}
                        {!! Form::text('name', '', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Фамилия'); !!}
                        {!! Form::text('second-name', '', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Логин'); !!}
                        {!! Form::text('login', '', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Пароль'); !!}
                        {!! Form::password('password', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Подтверждение пароля'); !!}
                        {!! Form::password('password-confirmation', ['class' => 'form-control', 'aria-describedby' => '']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Зарегистрироваться', ['class' => 'btn btn-primary', 'aria-describedby' => '']); !!}
                    </div>

                    {!! Form::close() !!}
                </div>
        </div>
    </div>
@endsection
