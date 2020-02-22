{{Form::label('description', __('forms.recipes.kitchen')) }}
@php($params = ['class'=>'form-control'])
@php($options = [1 => 'Японская', 0 => 'Китайская'])
{{Form::select('kitchen', $options, null, $params)}}
