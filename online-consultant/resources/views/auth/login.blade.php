@extends('web.layouts.index')

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Login') }}</div>

                        <div class="card-body">
                            {{ Form::open(['url' => route('login')]) }}
                                <div class="form-group">
                                    {{ Form::label('email', __('common.form_fields.email.label')) }}
                                    {{ Form::email('email', old('email'), ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'email', 'autofocus' => '']) }}

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{ Form::label('password', __('common.form_fields.password.label')) }}
                                    {{ Form::password('password', ['class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : '' ), 'required' => 'required', 'autocomplete' => 'current-password', 'value' => old('password')]) }}

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        {{ Form::checkbox('remember', old('password'), 1, ['class' => 'form-check-input' . ( $errors->has('password') ? ' is-invalid' : '' ), 'required' => 'required', 'autocomplete' => 'current-password']) }}
                                        {{ Form::label('remember', __('Remember Me'), ['class' => 'form-check-label']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::submit(__('Login'), ['class' => 'btn btn-primary btn-lg btn-block']) }}
                                </div>
                                <div class="form-group">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
