@include('cms.cities.blocks.form.errors')
{{ Form::open(['url' => route('cms.cities.store')]) }}
@include('cms.cities.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
