@include('projects.blocks.form.errors')

{{ Form::model($project, ['url' => route('cms.projects.update', ['project' => $project]), 'method' => 'PUT']) }}
@include('projects.blocks.form.fields')
<div class="form-group">
    {{ Form::submit('Изменить', array('class' => 'btn btn-success')) }}
</div>
{{ Form::close() }}
