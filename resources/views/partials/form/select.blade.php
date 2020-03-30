@php
    $name = $name ??'no-name';
    $option = $option ?? [];
    $value = old($name, $value ?? false);
    $parameters = [
            'id'=>"form-$name",
            'class'=>'form-control form-control-lg',
            'placeholder'=> $placeholder ?? '',
            'readOnly'=> $readOnly ?? false,
            'disabled'=> $disabled ?? false,
            'maxLength'=> $maxLength ?? false,

    ];
@endphp

<div class="form-group {{$errors->has($name) ? 'has-error' : ''}}">
    <label form="form-{{$name}}">{{$label ?? $name}}</label>
    {!! Form::select($name,$option, $value , $parameters) !!}

</div>

