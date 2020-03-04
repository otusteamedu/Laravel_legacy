<div class="col-12">{{__('forms.user.profile.sex.value')}}</div>
<div class="col-auto">
    <div class="custom-control custom-radio">
        {{ Form::radio('man', '1', false,['id'=>'man','class'=>'custom-control-input','name'=>'sex', ])}}
        {{ Form::label('man', __('forms.user.profile.sex.man'),['id'=>'man','class'=>'custom-control-label'])}}
    </div>
</div>
<div class="col-auto">
    <div class="custom-control custom-radio">
        {{ Form::radio('women', '0', false,['id'=>'women','name'=>'sex', 'class'=>'custom-control-input'])}}
        {{ Form::label('women', __('forms.user.profile.sex.women'),['id'=>'women','class'=>'custom-control-label'])}}
    </div>
</div>
