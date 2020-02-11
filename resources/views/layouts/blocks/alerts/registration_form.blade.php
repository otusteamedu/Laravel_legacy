<form id="contact-form" method="post" action="#" role="form">
    <div class="messages"></div>
    <div class="controls">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">Имя *</label>
                    <input id="form_name" type="text" name="name" class="form-control"
                           placeholder="Иван" required="required"
                           data-error="Обязательное поле">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_lastname">Фамилия *</label>
                    <input id="form_lastname" type="text" name="surname" class="form-control"
                           placeholder="Иванов" required="required"
                           data-error="Обязательное поле.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email *</label>
                    <input id="form_email" type="email" name="email" class="form-control"
                           placeholder="email@emai.com" required="required"
                           data-error="Обязательное поле.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">Телефон</label>
                    <input id="form_phone" type="tel" name="phone" class="form-control"
                           placeholder="+7 906 999 99 99">
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">Страна</label>
                    <input id="form_phone" type="text" name="country" class="form-control"
                           placeholder="Россия">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">Город</label>
                    <input id="form_phone" type="text" name="city" class="form-control"
                           placeholder="Москва">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Часовой пояс</label>
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
                    <label for="form_message">О себе</label>
                    <textarea id="form_message" name="message" class="form-control"
                              placeholder="Напишите кратко о себе." rows="4"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <!-- Replace data-sitekey with your own one, generated at https://www.google.com/recaptcha/admin -->
                    <div class="g-recaptcha" data-sitekey="6LfKURIUAAAAAO50vlwWZkyK_G2ywqE52NU7YO0S"></div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-md btn-primary btn-block" type="submit">Отправить</button>
            </div>
        </div>
    </div>
</form>
