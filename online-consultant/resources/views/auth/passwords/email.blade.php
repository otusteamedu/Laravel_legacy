@extends('web.layouts.index')

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">{{ __('Reset Password') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ Form::open(['url' => route('password.email')]) }}
                                <div class="form-group">
                                    {{ Form::label('email', __('common.form_fields.email.label')) }}
                                    {{ Form::email('email', old('email'), ['class' => 'form-control' . ( $errors->has('email') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'email', 'autofocus' => '']) }}
    
                                    @include('common.forms.errors.validation', ['field' => 'email'])
                                </div>
                                <div class="form-group">
                                    {{ Form::submit(__('Send Password Reset Link'), ['class' => 'btn btn-primary btn-lg btn-block']) }}
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
