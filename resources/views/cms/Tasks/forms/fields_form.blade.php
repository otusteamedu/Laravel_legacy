<div class="form-group">
    {{Form::label('name','Название задачи:')}}
    {{Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Задача для Андрея'])}}
</div>
<div class="form-group">
    {{Form::label('project_id','Урл проекта:')}}
    {{Form::select('project_id',$projects, null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('description','Описание:')}}
    {{Form::textarea('description',null, ['rows'=>'3','class' => 'form-control','placeholder'=>'Введите описание проекта'])}}
</div>
<div class="form-group">
    {{Form::label('user_id','Урл проекта:')}}
    {{Form::select('user_id',$users, null, ['class' => 'form-control'])}}
</div>
<div class="form-group">
    {{Form::submit('Отправить',array('class' =>'btn btn-success'))}}
</div>
