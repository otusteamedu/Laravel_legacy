<div class="content-wrapper d-flex align-items-center auth">
    <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                    <img src="{{ asset('/images/logo.svg')}}">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>

                {!! Form::open(['url' => 'foo/bar','class'=>'pt-3']) !!}

                    <div class="form-group">
                        {!! Form::email('email', $value = null,['id'=>'exampleInputEmail1','class'=>'form-control form-control-lg','placeholder'=>'Username']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::email('password', $value = null,['id'=>'exampleInputPassword1','class'=>'form-control form-control-lg','placeholder'=>'Password']) !!}

                    </div>
                    <div class="mt-3">
                        <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="/">{{__('auth.sign_in')}}</a>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <label class="form-check-label text-muted">
                                {!! Form::checkbox('checkbox', $value = null,['id'=>'checkbox1','class'=>'form-check-input']) !!}
                                Keep me signed in
                            </label>
                        </div>
                        <a href="#" class="auth-link text-black">Forgot password?</a>
                    </div>
                    <div class="mb-2">
                        {!! Form::button('<i class="mdi mdi-facebook mr-2"></i>Connect using facebook',['class'=>'btn btn-block btn-facebook auth-form-btn']) !!}
                    </div>
                    <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.html" class="text-primary">Create</a>
                    </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
