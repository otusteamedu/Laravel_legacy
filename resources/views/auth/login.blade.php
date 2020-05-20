@extends('layouts.auth')
@section('content')

    <div class="form_dt_user">
            <header>
                <h1>Log in</h1>
            </header>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <fieldset>
                    <label for="log">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </fieldset>
                <fieldset>
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </fieldset>
                <fieldset>
                    <label for="remember">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                    </label>
                </fieldset>
                <fieldset>
                    <button type="submit" class="submit button">
                        {{ __('Login') }}
                    </button>
                    <span>Don't you have an account yet? <a href="{{ route('register') }}">Sign up here </a></span>
                    @if (Route::has('password.request'))
                        <span>
                            <a target="_blank" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </span>
                    @endif
                </fieldset>
            </form>
    </div>
@endsection
