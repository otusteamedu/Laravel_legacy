@include('cms.tariffs.blocks.form.errors')

{{ Form::model($tariff, ['url' => route('cms.tariffs.update', ['tariff' => $tariff]), 'method' => 'PUT']) }}
@include('cms.tariffs.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
