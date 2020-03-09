<form id="contact-form" method="POST" action="{{ route('register') }}" role="form">
    @csrf
    <div class="messages"><!--@include('layouts.blocks.form.errors')--></div>
    <div class="controls">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">@lang('global.first_name') *</label>
                    <input id="form_name"
                           type="text"
                           name="name"
                           placeholder="@lang('global.default_first_name')"
                           class="form-control @error('name') is-invalid @enderror"
                           required="required"
                           value="{{ old('name') }}"
                           autocomplete="name"
                           autofocus
                           data-error="@lang('alerts/forms.required_field')">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_last_name">@lang('global.last_name') *</label>
                    <input id="form_last_name"
                           type="text"
                           name="last_name"
                           class="form-control @error('last_name') is-invalid @enderror"
                           placeholder="@lang('global.default_last_name')"
                           required="required"
                           value="{{ old('last_name') }}"
                           autocomplete="last_name"
                           data-error="@lang('alerts/forms.required_field')">
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email *</label>
                    <input id="form_email"
                           type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           autocomplete="email"
                           placeholder="@lang('alerts/forms.default_email')"
                           required="required"
                           data-error="@lang('alerts/forms.required_field')">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">@lang('global.phone_number') *</label>
                    <input id="form_phone"
                           type="tel"
                           name="phone"
                           class="form-control @error('phone') is-invalid @enderror"
                           required="required"
                           value="{{ old('phone') }}"
                           autocomplete="phone"
                           placeholder="+7 906 999 99 99">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_country">@lang('global.country') *</label>
                    <input id="form_country"
                           type="text"
                           name="country_id"
                           class="form-control @error('country_id') is-invalid @enderror"
                           autocomplete="country_id"
                           required="required"
                           value="{{ old('country_id') }}"
                           placeholder="@lang('global.default_country')">
                    @error('country_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_region">@lang('global.city') *</label>
                    <input id="form_region"
                           type="text"
                           name="region"
                           class="form-control @error('region') is-invalid @enderror"
                           required="required"
                           value="{{ old('region') }}"
                           autocomplete="region"
                           placeholder="@lang('global.default_city')">
                    @error('region')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_password">@lang('alerts/forms.password') *</label>
                    <input id="form_password"
                           type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required="required"
                           placeholder="@lang('alerts/forms.password_default')">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_password_confirmation">@lang('alerts/forms.confirm_password') *</label>
                    <input id="form_password_confirmation"
                           type="password"
                           name="password_confirmation"
                           class="form-control @error('password') is-invalid @enderror"
                           required="required"
                           placeholder="@lang('alerts/forms.password_default')">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_picture">@lang('global.picture')</label>
                    <input id="form_picture"
                           type="text"
                           name="picture_id"
                           class="form-control @error('picture_id') is-invalid @enderror"
                           autocomplete="picture_id"
                           required="required"
                           value="{{ old('picture_id') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">@lang('global.timezone')</label>
                    <select id="user_time_zone" class="form-control" size="0">
                        <option value="Hawaii">(GMT-10:00) Hawaii</option>
                        <option value="Alaska">(GMT-09:00) Alaska</option>
                        <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp;
                            Canada)
                        </option>
                        <option value="Arizona">(GMT-07:00) Arizona</option>
                        <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp;
                            Canada)
                        </option>
                        <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00)
                            Central Time (US &amp; Canada)
                        </option>
                        <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp;
                            Canada)
                        </option>
                        <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">@lang('alerts/forms.about_self')</label>
                    <!-- @ToDo: добавить поле в миграцию -->
                    <textarea id="form_message" name="message" class="form-control"
                              placeholder="@lang('alerts/forms.write_about_self')" rows="4"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <!-- Replace data-sitekey with your own one, generated at https://www.google.com/recaptcha/admin -->
                    <div class="g-recaptcha" data-sitekey="6LfKURIUAAAAAO50vlwWZkyK_G2ywqE52NU7YO0S"></div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-md btn-primary btn-block" type="submit">@lang('alerts/forms.send')</button>
            </div>
        </div>
    </div>
</form>
