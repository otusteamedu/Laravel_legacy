@extends('web.layouts.index')

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Change Password') }}</div>

                        <div class="card-body">
                            {{ Form::open(['url' => route('password.update')]) }}
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
                                    {{ Form::submit(__('Change Password'), ['class' => 'btn btn-primary btn-lg btn-block']) }}
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
