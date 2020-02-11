{{ Form::label($params['name'], $params['label'].($params['require']?'*':'')) }}
@switch($params['type'])
    @case('email')
    {{ Form::email($params['name'], $params['value'], ['class' => $params['class']??'', 'placeholder' => $params['placeholder']??'']) }}
    @break
    @case('select')
    {{ Form::select($params['name'], $params['options'], $params['value'], ['class' => $params['class']??'', 'placeholder' => $params['placeholder']??'']) }}
    @break
    @case('file')
    @if($params['value'])
        <img src="<?= $params['value']; ?>">
    @endif
    {{ Form::file($params['name'], ['class' => $params['class']??'', 'placeholder' => $params['placeholder']??'']) }}
    @break
    @case('password')
    {{ Form::password($params['name'], ['class' => $params['class']??'', 'placeholder' => $params['placeholder']??'']) }}
    @break
    @case('text')
    @default
    {{ Form::text($params['name'], $params['value'], ['class' => $params['class']??'', 'placeholder' => $params['placeholder']??'']) }}
    @break
@endswitch