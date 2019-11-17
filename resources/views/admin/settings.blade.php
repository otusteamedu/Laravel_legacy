@extends('admin.layouts.admin')
@section('content')
    <h1>
        Настройки
    </h1>
    <hr>

    {!!
        Form::model($settings,['method'=>'POST', 'url' => route('admin.settings.store')])
    !!}
    {{ Form::token()}}

    <div class="row form-group">
        {{ Form::label('name', 'Название',['class'=>'col-lg-2']) }}
        {{ Form::text('name',$settings->name ,[
            'class'=>'form-control col-lg-10',
        ] ) }}
    </div>

    {{Form::submit('Сохранить',[
    'class'=>'btn btn-primary',
                'name'=>'save'])}}

    {!! Form::close() !!}



@endsection
