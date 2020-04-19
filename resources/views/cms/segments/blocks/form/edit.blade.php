@include('cms.segments.blocks.form.errors')

{{ Form::model($segment, ['url' => route('cms.segments.update', ['segment' => $segment]), 'method' => 'PUT']) }}
@include('cms.segments.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
