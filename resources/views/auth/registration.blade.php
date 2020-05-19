@extends('layouts.welcome')

@section('welcome_content')
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">

                <h4 class="text-center">@lang('auth.Register')</h4>
                <p>@lang('We will contact you')</p>

                {!! Form::open(['url' => '/']) !!}

                <div class="form-group row">
                    {{ Form::label('email', __('auth.Email'), ['class' => 'col-sm-2 col-form-label']) }}
                    {{ Form::email(
                        'email',
                        null,
                        ['class' => 'col-sm-10', 'required']
                    ) }}
                </div>
                <div class="form-group row">
                    {{ Form::label('full_name', __('scheduler.full_name'), ['class' => 'col-sm-2 col-form-label']) }}
                    {{ Form::text(
                        'full_name',
                        null,
                        ['class' => 'col-sm-10']
                    ) }}
                </div>
                <div class="form-group row">
                    {{ Form::label('tel', __('scheduler.tel'), ['class' => 'col-sm-2 col-form-label']) }}
                    {{ Form::text(
                        'tel',
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
