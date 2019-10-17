<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            {{ Form::label('name', trans('messages.name')) }}
            {{ Form::text('name', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            {{ Form::label('email', trans('messages.email')) }}
            {{ Form::text('email', null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            {{ Form::label('password', trans('messages.password')) }}
            {{ Form::password('password', array('class'=>'form-control')) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            {{ Form::label('level', trans('messages.level')) }}
            @php
                $levels = \App\Helpers\Views\Cms\CmsHelpers::getTranslatedCMSConfigs('users', 'level');
            @endphp
            {{ Form::select('level', $levels, null, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            {{ Form::label('photo', trans('messages.photo')) }}
            {{ Form::file('photo', array('class'=>'form-control')) }}
        </div>
    </div>
</div>