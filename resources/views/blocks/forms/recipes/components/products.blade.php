{{Form::label('title', __('forms.recipes.products.value')) }}
@php($params = [
    'class' => 'form-control',
    'rows' => 5,
    'placeholder' => __('forms.recipes.products.placeholder'),
])
{{ Form::textarea('products', '', $params)}}
