@include('cms.segments.blocks.form.errors')
{{ Form::open(['url' => route('cms.segments.store')]) }}
@include('cms.segments.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
