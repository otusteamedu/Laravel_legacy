{{-- Form | Register --}}

{{ Form::open(['url' => route('register')]) }}
    <div class="form-group">
        {{ Form::label('name', __('common.form_fields.name.label')) }}
        {{ Form::text('name', old('name'), ['class' => 'form-control' . ( $errors->has('name') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'name', 'autofocus' => '']) }}

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        {{ Form::label('email', __('common.form_fields.email.label')) }}
        {{ Form::email('email', old('email'), ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'email']) }}

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        {{ Form::label('password', __('common.form_fields.password.label')) }}
        {{ Form::password('password', ['class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'new-password', 'value' => old('password')]) }}

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        {{ Form::submit(__('Register'), ['class' => 'btn btn-primary btn-lg btn-block']) }}
    </div>
{{ Form::close() }}
