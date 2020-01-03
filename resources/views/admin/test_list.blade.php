@extends('admin.layouts.admin')
@section('content')
<h1>Тесты</h1>
<hr>
@forelse($tests as $t)
    {!!
        Form::model($tests,['method'=>'PUT', 'url' => route('admin.tests.update',$t->id )])
    !!}
    {{ Form::token()}}
    <div class="row form-group">
        {{Form::label('id', 'ID',['class'=>'col-lg-2'])}}
        {{Form::text('id',$t->id,[
            'class'=>'form-control col-lg-10',
            'id'=>'meta_description',
            'readonly'=> 'true'
        ])}}
    </div>
    <div class="row form-group">
        {{Form::label('name', 'Вопрос',['class'=>'col-lg-2'])}}
        {{Form::text('name', $t->name,[
            'class'=>'form-control col-lg-10',
            'id'=>'id'
        ])}}
    </div>
    <div class="row form-group">
        {{Form::label('text', 'Варианты ответов',['class'=>'col-lg-2'])}}
        {{Form::textarea('text',$t->text,[
            'class'=>'form-control editor col-lg-10',
            'id'=>'text'
        ])}}
    </div>
    <div class="row form-group">
        {{Form::label('lessen_id', 'Урок',['class'=>'col-lg-2'])}}
        {{Form::select('lessen_id', $listGrammar,$t->lessen_id)}}
    </div>
    <div class="row form-group">
        {{Form::label('status', 'Статус',['class'=>'col-lg-2'])}}
        {{Form::number('status',$t->status,[
            'class'=>'form-control col-lg-10',
            'id'=>'status'
        ])}}
    </div>
    {{Form::submit('Обновить',[
'class'=>'btn btn-primary',
           'name'=>'save'])}}
    {!! Form::close() !!}



    <hr>
@empty
    <p>тестов нет</p>
@endforelse

<h1>Добавить тест</h1>

{!! Form::model($tests,['method'=>'POST', 'url' => route('admin.tests.store')]) !!}
{{ Form::token()}}

<div class="row form-group">
    {{Form::label('name', 'Вопрос',['class'=>'col-lg-2'])}}
    {{Form::text('name', '',[
        'class'=>'form-control col-lg-10',
        'id'=>'id'
    ])}}
</div>
<div class="row form-group">
    {{Form::label('text', 'Варианты ответов',['class'=>'col-lg-2'])}}
    {{Form::textarea('text','',[
        'class'=>'form-control editor col-lg-10',
        'id'=>'text'
    ])}}
</div>
<div class="row form-group">
    {{Form::label('lessen_id', 'Урок',['class'=>'col-lg-2'])}}
    {{Form::select('lessen_id', $listGrammar,$t->lessen_id)}}
</div>
{{Form::submit('Добавить',[
'class'=>'btn btn-primary',
       'name'=>'save'])}}
{!! Form::close() !!}




<script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>
<script>
    var editors = document.querySelectorAll('.editor');
    editors.forEach((item) => {
        ClassicEditor
            .create(item)
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection
