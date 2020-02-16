<form class="form-signin">
    <label for="inputEmail" class="sr-only">Email</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="@lang('alerts/forms.default_email')" required="" autofocus="">
    <label for="inputPassword" class="sr-only">@lang('alerts/forms.password')</label>
    <input type="password" id="inputPassword" class="form-control my-2" placeholder="@lang('alerts/forms.password_default')" required="">
    <div class="checkbox mb-3 mt-2">
        <label>
            <input type="checkbox" value="remember-me"> @lang('alerts/forms.remember_me')
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">@lang('alerts/forms.come_in')</button>
</form>
