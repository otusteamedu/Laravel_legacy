{{Form::label('description', __('forms.recipes.category')) }}
@php($params = ['class'=>'form-control'])
@php($options = [1 => 'Первое блюдо', 0 => 'Второе блюдо'])
{{Form::select('category', $options, null, $params)}}
