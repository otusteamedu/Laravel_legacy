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
                    <h4>{{__('auth.name-placeholder')}}</h4>
                    <h6 class="font-weight-light">{{__('auth.sign_easy')}}</h6>


                    {!! Form::open(['url' => route('register',['locale' => $locale]),'class'=>'pt-3']) !!}

                    @include('partials.form.email', [
                         "label"=> __('form.email'),
                         "name"=> "email",
                         "required"=> true,
                         "placeholder"=>  __('form.email-placeholder'),
                    ])

                    @include('partials.form.password', [
                         "label"=> __('form.password'),
                         "name"=> "password",
                         "placeholder"=>  __('form.password-placeholder'),
                    ])

                    @include('partials.form.password', [
                         "label"=> __('form.password'),
                         "name"=> "password_confirmation",
                         "placeholder"=>  __('form.password-placeholder'),
                    ])
                    <div class="mb-4">
                        <div class="form-check">
                            <label class="form-check-label text-muted">
                                <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions
                            </label>
                        </div>
                    </div>
                    <div class="mt-3">
                        {!! Form::submit(__('Register',['locale' => $locale]) ,['class'=>'btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn']) !!}
                    </div>
                    <div class="text-center mt-4 font-weight-light"> Already have an account? <a
                            href="{{ route('login',['locale' => $locale]) }}" class="text-primary">Login</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
