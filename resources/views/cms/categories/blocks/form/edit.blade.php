@include('categories.blocks.form.errors')

{{ Form::model($segment, ['url' => route('cms.categories.update', ['segment' => $segment]), 'method' => 'PUT']) }}
@include('categories.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Изменить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
