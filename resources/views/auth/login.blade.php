@extends('app-specialty')

@section('content')
<div class="content-wrapper d-flex align-items-center auth">
    <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
            @include('partials.system.status')
            <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                    <img src="{{ asset('/images/logo.svg')}}">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>

                {!! Form::open(['url' =>  route('login',['locale' => $locale]),'class'=>'pt-3']) !!}

                @include('partials.form.email', [
                     "label"=> __('form.name'),
                     "name"=> "email",
                     "placeholder"=>  __('form.name-placeholder'),
                ])

                @include('partials.form.password', [
                     "label"=> __('form.password'),
                     "name"=> "password",
                     "placeholder"=>  __('form.password-placeholder'),
                ])

                <div class="mt-3">
                    {!! Form::submit(__('auth.sign_in') ,['class'=>'btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn']) !!}
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <label class="form-check-label text-muted">
                            @include('partials.form.checkbox', [
                                 "label"=> __('form.name'),
                                 "name"=> "remember",
                                 "placeholder"=>  __('form.name-placeholder'),
                            ])
                            Keep me signed in
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request',['locale' => $locale]) }}" class="auth-link text-black">{{ __('Forgot Your Password?') }}</a>
                    @endif

                </div>
                <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="{{ route('register',['locale' => $locale]) }}" class="text-primary">Create</a>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection
