{{Form::label('title', __('forms.recipes.title.value')) }}
@php($params = [
    'class' => 'form-control',
    'placeholder' => __('forms.recipes.title.placeholder'),
])
{{ Form::text('title', '', $params)}}
