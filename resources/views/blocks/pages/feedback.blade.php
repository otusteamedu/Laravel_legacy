<div class="card">
    <div class="card-body">

        <h4 class="text-center">@lang('scheduler.feedback')</h4>

        {!! Form::open(['url' => '/']) !!}

        <div class="form-group row">
            {{ Form::label('email', __('scheduler.email'), ['class' => 'col-sm-2 col-form-label']) }}
            {{ Form::email(
                'email',
                null,
                ['class' => 'col-sm-10', 'required']
            ) }}
        </div>
        <div class="form-group row">
            {{ Form::label('tel', __('scheduler.tel'), ['class' => 'col-sm-2 col-form-label']) }}
            {{ Form::tel(
                'tel',
                null,
                ['class' => 'col-sm-10']
            ) }}
        </div>
        <div class="form-group row">
            {{ Form::label('text', __('scheduler.text'), ['class' => 'col-sm-2 col-form-label']) }}
            {{ Form::textarea(
                'text',
                null,
                ['class' => 'col-sm-10']
            ) }}
        </div>

        {{Form::submit(__('buttons.submit'), ['class' => 'btn btn-primary'])}}

        {!! Form::close() !!}
    </div>
</div>
