@extends('auth._layout')

@section('content')

<div class="login-content">
    <div class="login-logo">
        <a href="{{route('main')}}">
            <img class="align-content" src="/images/logo.png" alt="">
        </a>
    </div>
    <div class="login-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                </label>
                <label class="pull-right">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        Вспомнить пароль
                    </a>
                    @endif
                </label>
            </div>

            <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Войти</button>


            {{--<div class="social-login-content">

                <div class="social-button">
                    <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                    <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                </div>

            </div>--}}


            <div class="register-link m-t-15 text-center">
                @if (Route::has('register'))
                <p>Нет аккаунта? <a href="{{ route('register') }}">Регистрация</a></p>
                @endif

            </div>
        </form>
    </div>
</div>

@endsection
