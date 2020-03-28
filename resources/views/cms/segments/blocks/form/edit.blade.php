@include('segments.blocks.form.errors')

{{ Form::model($segment, ['url' => route('cms.segments.update', ['segment' => $segment]), 'method' => 'PUT']) }}
@include('segments.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Изменить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
