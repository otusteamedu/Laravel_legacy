<form id="contact-form" method="post" action="#" role="form">
    <div class="messages"></div>
    <div class="controls">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">@lang('global.first_name') *</label>
                    <input id="form_name" type="text" name="name" class="form-control"
                           placeholder="@lang('global.default_first_name')" required="required"
                           data-error="@lang('alerts/forms.required_field')">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_lastname">@lang('global.last_name') *</label>
                    <input id="form_lastname" type="text" name="surname" class="form-control"
                           placeholder="@lang('global.default_last_name')" required="required"
                           data-error="@lang('alerts/forms.required_field')">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email *</label>
                    <input id="form_email" type="email" name="email" class="form-control"
                           placeholder="@lang('alerts/forms.default_email')" required="required"
                           data-error="@lang('alerts/forms.required_field')">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">@lang('global.phone_number')</label>
                    <input id="form_phone" type="tel" name="phone" class="form-control"
                           placeholder="+7 906 999 99 99">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">@lang('global.country')</label>
                    <input id="form_phone" type="text" name="country" class="form-control"
                           placeholder="@lang('global.default_country')">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">@lang('global.city')</label>
                    <input id="form_phone" type="text" name="city" class="form-control"
                           placeholder="@lang('global.default_city')">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_password">@lang('alerts/forms.password')</label>
                    <input id="form_password" type="text" name="password" class="form-control"
                           placeholder="@lang('alerts/forms.password_default')">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_confirm_password">@lang('alerts/forms.confirm_password')</label>
                    <input id="form_confirm_password" type="text" name="city" class="form-control"
                           placeholder="@lang('alerts/forms.password_default')">
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
