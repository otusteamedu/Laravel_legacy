<form method="POST" class="form-signin" action="{{ route('login') }}">
    @csrf
    <div class="form-group row">
        <label for="email">Email *</label>
        <input id="email" type="email" placeholder="@lang('alerts/forms.default_email')" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="form-group row">
        <label for="password">@lang('alerts/forms.password') *</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="@lang('alerts/forms.password_default')" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="checkbox mb-3 mt-2">
            <label>
                <input id="remember" type="checkbox" name="remember" value="remember-me"> @lang('alerts/forms.remember_me')
            </label>
        </div>
    </div>

    <div class="form-group row">
        <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('alerts/forms.come_in')</button>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                @lang('alerts/forms.forgot_your_password')
            </a>
        @endif
    </div>
</form>
