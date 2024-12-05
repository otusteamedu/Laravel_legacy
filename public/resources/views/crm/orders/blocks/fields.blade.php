<div class="form-group">
    {{ Form::label('date', 'Дата') }}
    <br>
    {{ Form::text('date') }}
</div>
<div class="form-group">
    {{ Form::label('amount', 'Количество') }}
    <br>
    {{ Form::text('amount') }}
</div>
<div class="form-group">
    {{ Form::submit('Сохранить', ['class' => 'btn btn-outline-primary']) }}
</div>
