@extends('web.layouts.index')

@section('content')
    <section class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="card">
                        <div class="card-header">{{ __('Change Password') }}</div>

                        <div class="card-body">
                            {{ Form::open(['url' => route('password.update')]) }}
                                @csrf
                                <div class="form-group">
                                    {{ Form::label('password', __('common.form_fields.password.label')) }}
                                    {{ Form::password('password', ['class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'current-password', 'autofocus' => '', 'value' => old('password')]) }}
                                    @include('common.forms.errors.validation', ['field' => 'password'])
                                </div>
                                <div class="form-group">
                                    {{ Form::label('password_confirmation', __('common.form_fields.password_confirmation.label')) }}
                                    {{ Form::password('password_confirmation', ['class' => 'form-control' . ( $errors->has('password') ? ' is-invalid' : '' ), 'required' => '', 'autocomplete' => 'new-password', 'value' => old('password')]) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::hidden('token', $token) }}
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
