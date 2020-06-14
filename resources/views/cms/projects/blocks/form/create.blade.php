@include('cms.projects.blocks.form.errors')

{{ Form::open(['url' => route('cms.projects.store'), 'enctype="multipart/form-data"']) }}

@include('cms.projects.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
