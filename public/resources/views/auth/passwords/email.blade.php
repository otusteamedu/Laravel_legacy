@extends('auth._layout')

@section('content')

<div class="login-content">
    <div class="login-logo">
        <a href="{{route('main')}}">
            <img class="align-content" src="/images/logo.png" alt="">
        </a>
    </div>
    <div class="login-form">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
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
            <button type="submit" class="btn btn-primary btn-flat m-b-15">Submit</button>

        </form>
    </div>
</div>

@endsection
