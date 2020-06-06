@extends('layouts.blank')

@section('title', __('headers.register'))

@section('content')
    <form method="POST" action="{{ route('register') }}" class="form-center">
        @csrf

        <a href="/">
            <img class="mb-4 border rounded py-3" src="/images/icon.svg" alt="" width="72" height="72">
        </a>

        <div class="form-group text-left">
            <label for="name">{{ __('Name') }}</label>

            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group text-left">
            <label for="email">{{ __('E-Mail Address') }}</label>

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group text-left">
            <label for="password">{{ __('Password') }}</label>

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group text-left">
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                   autocomplete="new-password">
        </div>

        <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
@endsection
