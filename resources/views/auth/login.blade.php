@extends('layouts.welcome')

@section('welcome_content')
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">

                <h4 class="text-center">@lang('auth.Login')</h4>

                {!! Form::open(['url' => '/']) !!}

                <div class="form-group row">
                    {{ Form::label('login', __('auth.Login'), ['class' => 'col-sm-2 col-form-label']) }}
                    {{ Form::text(
                        'login',
                        null,
                        ['class' => 'col-sm-10', 'required']
                    ) }}
                </div>
                <div class="form-group row">
                    {{ Form::label('password', __('auth.Password'), ['class' => 'col-sm-2 col-form-label']) }}
                    {{ Form::password(
                        'password',
                        null,
                        ['class' => 'col-sm-10']
                    ) }}
                </div>

                {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
