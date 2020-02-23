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
            {{ Form::label('rights', __('cms.group.fields.rights')) }}
        </div>
    </div>
    <div class="col-8 col-md-8">
        <div class="form-group">
            {{ Form::select('rights[]', $rights, null, ['class'=>'selectpicker form-control', 'multiple'])}}
        </div>
    </div>
</div>
<div class="row mr-0 ml-0">
    <div class="col-11 pb-3 align-content-end text-right">
        {{Form::submit(__('cms.actions.create'), ['class' => 'btn btn-success'])}}
    </div>
</div>