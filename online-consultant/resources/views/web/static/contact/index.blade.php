@extends('web.layouts.index')

@section('title', __('common.pages.contact'))

@section('content')
    <section class="page-section static-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>{{ __('common.pages.contact') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section section-contact-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-contact-info">
                    <div class="contact-info mb-4 mb-lg-0 pb-4 pb-lg-0">
                        <h2 class="mb-4">{{ __('common.app_name') }}</h2>
                        <p>{{ __('Address:') }} USA, New York, First St., 1</p>
                        <p>{{ __('common.form_fields.email.label') }} info@online-consultant.com</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contacts-form">
                        {{ Form::open(['url' => '']) }}
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
                            {{ Form::label('phone_number', __('common.form_fields.phone_number.label')) }}
                            {{ Form::text('phone_number', old('phone_number'), ['class' => 'form-control' . ( $errors->has('phone_number') ? ' is-invalid' : '' )]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('message', __('common.form_fields.message.label')) }}
                            {{ Form::textarea('message', old('message'), ['class' => 'form-control' . ( $errors->has('message') ? ' is-invalid' : '' ), 'required' => '']) }}

                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary btn-lg btn-block']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
