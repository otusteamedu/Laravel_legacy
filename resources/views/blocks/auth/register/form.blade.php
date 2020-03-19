{!! Form::open(['url' => route('register'), 'method' => 'post']) !!}

<div class="form-group row">
    <label for="name"
           class="col-md-4 col-form-label text-md-right">@lang('register.label.name')</label>

    <div class="col-md-6">

        {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required', 'autocomplete'=>'name', 'autofocus' => 'autofocus']); !!}

        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email"
           class="col-md-4 col-form-label text-md-right">@lang('register.label.email')</label>

    <div class="col-md-6">
        {!! Form::text('email', old('email'), ['class' => 'form-control', 'required' => 'required', 'autocomplete'=>'email']); !!}

        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password"
           class="col-md-4 col-form-label text-md-right">@lang('register.label.password')</label>

    <div class="col-md-6">
        {!! Form::password('password', old('password'), ['class' => 'form-control', 'required' => 'required']); !!}

        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm"
           class="col-md-4 col-form-label text-md-right">@lang('register.label.confirm')</label>

    <div class="col-md-6">
        {!! Form::password('password_confirmation', old('password_confirmation'), ['class' => 'form-control', 'required' => 'required']); !!}
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            @lang('register.label.button')
        </button>
    </div>
</div>
{!! Form::close() !!}
