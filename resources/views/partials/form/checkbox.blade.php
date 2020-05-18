@php
    $name = $name ??'no-name';
    $value = old($name, $value ?? false);
    $parameters = [
            'id'=>"form-$name",
            'class'=>'form-check-input',
    ];
@endphp
{!! Form::checkbox('remember', $value = null,$parameters) !!}
