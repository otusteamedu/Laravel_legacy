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
                $levels = [
                    \App\Models\User::LEVEL_USER => __('cms.users.level.' . \App\Models\User::LEVEL_USER),
                    \App\Models\User::LEVEL_MODERATOR => __('cms.users.level.' . \App\Models\User::LEVEL_MODERATOR),
                    \App\Models\User::LEVEL_ADMIN => __('cms.users.level.' . \App\Models\User::LEVEL_ADMIN),
                ];
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