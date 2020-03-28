@include('cms.tariffs.blocks.form.errors')
{{ Form::open(['url' => route('cms.tariffs.store')]) }}
@include('cms.tariffs.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
