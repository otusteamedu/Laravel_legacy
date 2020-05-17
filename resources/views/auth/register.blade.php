@extends('layouts.auth')
@section('content')
    <div class="form_dt_user">
        <header>
            <h1>Зарегистрируйтесь, это бесплатно..</h1>
        </header>
        <form method="POST" action="{{ route('register') }}" class="register_form">
            @csrf
            <fieldset>
                <label for="user_name">{{ __('Name') }}</label>
                <input id="name" type="text" placeholder="Ivanov" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" placeholder="ivanov@email.com" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </fieldset>
            <fieldset>
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </fieldset>
            <fieldset class="min fix">
                <label for="dt_name">Имя</label>
                <input type="text" placeholder="Иван" id="firstname" name="firstname" value="" required="">
            </fieldset>
            <fieldset class="min">
                <label for="dt_last_name">Фамилия</label>
                <input type="text" placeholder="Иванов" id="lastname" name="lastname" value="" required="">
            </fieldset>
            <fieldset>
                <button type="submit" class="submit button">
                    {{ __('Register') }}
                </button>
                <span>У вас уже есть аккаунт? <a href="/login">Войдите здесь</a></span>
            </fieldset>

        </form>
    </div>
@endsection
