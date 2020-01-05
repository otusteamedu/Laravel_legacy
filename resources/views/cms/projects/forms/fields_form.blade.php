<div class="form-group">
    {{Form::label('name','Урл проекта:')}}
    {{Form::text('name',null, ['class' => 'form-control','placeholder'=>'Введите урл проекта'])}}
</div>
<div class="form-group">
    {{Form::label('description','Описание:')}}
    {{Form::text('description',null, ['class' => 'form-control','placeholder'=>'Введите описание проекта'])}}
</div>
<div class="form-group">
    {{Form::label('report_day','День отчета:')}}
    {{Form::number('report_day',null, ['class' => 'form-control','placeholder'=>'Введите число отчета: от 1 до 31'])}}
</div>
<div class="form-group">
    {{Form::submit('Отправить',array('class' =>'btn btn-success'))}}
</div>
