@php
    $name = $name ??'no-name';
    $value = old($name, $value ?? false);
    $parameters = [
            'id'=>"form-$name",
            'class'=>'form-control form-control-lg',
            'placeholder'=> $placeholder ?? '',
            'readOnly'=> $readOnly ?? false,
            'disabled'=> $disabled ?? false,
            'maxLength'=> $maxLength ?? false,
            'rows'=> $rows ?? 3
    ];
@endphp

<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <label form="form-{{$name}}">{{$label ?? $name}}</label>
    {!! Form::textarea($name, $value , $parameters) !!}
</div>
