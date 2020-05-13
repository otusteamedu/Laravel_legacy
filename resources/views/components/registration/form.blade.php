<div class="card">
    <div class="card-header">@lang('app.registration.form_header')</div>
    <div class="card-body">
        <form>
            <div class="form-group row">
                <label for="user_name"
                       class="col-md-4 col-form-label text-md-right">@lang('app.registration.user_name')</label>
                <div class="col-md-6">
                    <input type="text" id="user_name" class="form-control" name="username">
                </div>
            </div>
            <div class="form-group row">
                <label for="full_name"
                       class="col-md-4 col-form-label text-md-right">@lang('app.registration.full_name')</label>
                <div class="col-md-6">
                    <input type="text" id="full_name" class="form-control" name="full-name">
                </div>
            </div>
            <div class="form-group row">
                <label for="email_address"
                       class="col-md-4 col-form-label text-md-right">@lang('app.registration.email')</label>
                <div class="col-md-6">
                    <input type="text" id="email_address" class="form-control" name="email-address">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        @lang('app.registration.submit_button')
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
