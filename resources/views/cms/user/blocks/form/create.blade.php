<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('name', __('cms.fields.name')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::text('name', old('name'), ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('icon', __('cms.fields.icon')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::file('icon', ['accept' => 'image/jpeg,image/png']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('email', __('cms.user.fields.email')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::email('email', null, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('password', __('cms.user.fields.password')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::password('password', ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('password_confirmation', __('cms.user.fields.confirmPassword')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('group', __('cms.user.fields.group')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::select('group_id', $groups, null, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-11 pb-3 align-content-end text-right">
        {{Form::submit(__('cms.actions.create'), ['class' => 'btn btn-success'])}}
    </div>
</div>