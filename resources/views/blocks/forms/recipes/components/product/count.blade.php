@php($params = [
    'class' => 'form-control',
    'placeholder' => 100,
])
{{ Form::text('count-products', '', $params)}}
