@extends('auth._layout')

@section('content')

<div class="login-content">
    <div class="login-logo">
        <a href="{{route('main')}}">
            <img class="align-content" src="/images/logo.png" alt="">
        </a>
    </div>
    <div class="login-form">
        <form method="POST" action="{{ route('register') }}">
        @csrf
            <div class="form-group">
                <label>Имя</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Email </label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Мобильный телефон</label>
                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Подтверждение пароля</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Согласен с политикой безопасности
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Регистрация</button>
            {{--<div class="social-login-content">
                <div class="social-button">
                    <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Register with facebook</button>
                    <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Register with twitter</button>
                </div>
            </div>--}}
            <div class="register-link m-t-15 text-center">
                <p>Уже есть аккаунт ? <a href="{{route('login')}}"> Войти</a></p>
            </div>
        </form>
    </div>
</div>

@endsection
