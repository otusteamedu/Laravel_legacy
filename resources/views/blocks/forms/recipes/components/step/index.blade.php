<h5 class="col-12">{{__('forms.recipes.steps')}}</h5>
<div class="col-12 col-md-5">
    {{ Form::label('step-photo', __('forms.recipes.step.photo'))}}
    @php($params = ['class' => 'form-control-file'])
    {{ Form::file('step-photo', $params)}}
    {{ Form::label('step-photo', ' ')}}
    @php($params = ['class' => 'form-control-file'])
    {{ Form::file('step-photo', $params)}}
</div>
<div class="col">
    {{ Form::label(__('forms.recipes.step.photo'), __('forms.recipes.step.value'))}}
    @php($params = [
        'rows'=>'4',
        'class' => 'form-control',
        'placeholder' => __('forms.recipes.step.placeholder')
    ])
    {{ Form::textarea('title', '', $params)}}
</div>
<div class="col-12 d-flex justify-content-end mt-3">
    {{Form::button(__('forms.recipes.step.remove') , ['class' => 'btn btn-danger mr-3'])}}
    {{Form::button(__('forms.recipes.step.add') , ['class' => 'btn btn-info'])}}
</div>
