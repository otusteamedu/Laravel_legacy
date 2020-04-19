@include('cms.projects.blocks.form.errors')

{{ Form::model($project, ['url' => route('cms.projects.update', ['project' => $project]), 'method' => 'PUT']) }}
@include('cms.projects.blocks.form.fields', $project)
<div class="form-group">
    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
