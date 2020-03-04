@php($params = ['class'=>'form-control'])
@php($options = [1 => 'Опубликоваить', 0 => 'Не опубликовывать'])
{{Form::select('publish', $options, null, $params)}}
