{{-- Form | Register user --}}

{{ Form::open(['url' => route('register')]) }}
    <div class="form-group">
        {{ Form::label('name', __('common.form_fields.name.label')) }}
        {{ Form::text('name', old('name'), ['class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'name', 'autofocus' => '']) }}
        @include('common.forms.errors.validation', ['field' => 'name'])
    </div>
    <div class="form-group">
        {{ Form::label('email', __('common.form_fields.email.label')) }}
        {{ Form::email('email', old('email'), ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'email']) }}
        @include('common.forms.errors.validation', ['field' => 'email'])
    </div>
    <div class="form-group">
        {{ Form::label('password', __('common.form_fields.password.label')) }}
        {{ Form::password('password', ['class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'new-password']) }}
        @include('common.forms.errors.validation', ['field' => 'password'])
    </div>
    <div class="form-group">
        {{ Form::label('password_confirmation', __('common.form_fields.password_confirmation.label')) }}
        {{ Form::password('password_confirmation', ['class' => 'form-control' . ( $errors->has('password_confirmation') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'new-password']) }}
        @include('common.forms.errors.validation', ['field' => 'password_confirmation'])
    </div>
    <div class="form-group">
        {{ Form::submit(__('Register'), ['class' => 'btn btn-primary btn-lg btn-block']) }}
    </div>
{{ Form::close() }}
