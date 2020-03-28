@include('tariffs.blocks.form.errors')

{{ Form::model($tariff, ['url' => route('cms.tariffs.update', ['tariff' => $tariff]), 'method' => 'PUT']) }}
@include('tariffs.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Изменить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
