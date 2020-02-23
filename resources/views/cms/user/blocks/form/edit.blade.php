<?php /** @var \App\Models\User\User $user */?>
<div class="row mr-0 ml-0">
    <div class="col-3 col-md-3">
        <div class="form-group">
            {{ Form::label('name', __('cms.fields.name')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::text('name', $user->name, ['class'=>'form-control', 'required' => 'required']) }}
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
            @if ($user->icon)
                <img src="{{$image['path']}}/{{$image['image']}}">
                <br>
                {{Form::checkbox('icon_destroy', 1, null, ['id' => 'icon_destroy'])}}
                {{Form::label('icon_destroy', __('cms.actions.destroy'))}}
                <br>
            @endif
            {{ Form::file('icon', ['accept' => 'image/jpeg,image/png']) }}
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
            {{ Form::select('group_id', $groups, $user->group->id, ['class'=>'form-control']) }}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-11 pb-3 align-content-end text-right">
        {{Form::submit(__('cms.actions.update'), ['class' => 'btn btn-success'])}}
    </div>
</div>