{{ Form::open(['url' => route('proxy.store'), 'method' => 'post', 'files'=>'true']) }}


    @include('main.proxy.components.forms.errors', $errors->toArray() ?? [])
    @include('main.proxy.components.forms.fields')
{!! Form::close() !!}
