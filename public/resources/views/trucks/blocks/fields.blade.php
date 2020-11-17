<div class="form-group">
    {{ Form::label('brand', 'Марка') }}
    <br>
    {{ Form::text('brand') }}
</div>
<div class="form-group">
    {{ Form::label('plate', 'Номер') }}
    <br>
    {{ Form::text('plate') }}
</div>
<div class="form-group">
    {{ Form::label('cars', 'Вместимость') }}
    <br>
    {{ Form::text('cars') }}
</div>
<div class="form-group">
    {{ Form::submit('Сохранить', ['class' => 'btn btn-outline-primary']) }}
</div>
