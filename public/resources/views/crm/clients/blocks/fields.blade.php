<div class="form-group">
    {{ Form::label('name', 'Название') }}
    <br>
    {{ Form::text('name') }}
</div>
<div class="form-group">
    {{ Form::label('region_id', 'Регион') }}
    <br>
    {{ Form::text('region_id') }}
</div>
<div class="form-group">
    {{ Form::submit('Сохранить', ['class' => 'btn btn-outline-primary']) }}
</div>
