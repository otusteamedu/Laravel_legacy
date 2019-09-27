@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">{{ __('Account Settings') }}</p>
            </header>

            <div class="card-content">
                <div class="content">
                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf

                        <div class="field">
                            <label for="name" class="label">{{ __('Name') }}</label>

                            <div class="control">
                                <input id="name" type="text" class="input @error('name') is-danger @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="email"
                                   class="label">{{ __('E-Mail Address') }}</label>

                            <div class="control">
                                <input id="email" type="email" class="input @error('email') is-danger @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            @error('email')
                            <p class="help is-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="old-password"
                                   class="label">{{ __('Old Password') }}</label>

                            <div class="control">
                                <input id="old-password" type="password"
                                       class="input @error('old-password') is-danger @enderror" name="old-password"
                                       autocomplete="off">
                            </div>
                            @error('old-password')
                            <span class="help is-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="password"
                                   class="label">{{ __('Password') }}</label>

                            <div class="control">
                                <input id="password" type="password"
                                       class="input @error('password') is-danger @enderror" name="password"
                                       autocomplete="off">
                            </div>
                            @error('old-password')
                            <span class="help is-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="password-confirm"
                                   class="label">{{ __('Confirm Password') }}</label>

                            <div class="control">
                                <input id="password-confirm" type="password" class="input"
                                       name="password_confirmation" autocomplete="off">
                            </div>
                        </div>

                        <div class="field">
                            <button type="submit" class="button is-link">
                                {{ __('Update Settings') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection