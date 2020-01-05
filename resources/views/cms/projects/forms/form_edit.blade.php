{{ Form::model($project, ['route' => ['csm.projects.update',$project->id],'method' => 'PUT']) }}
@include('cms.projects.forms.fields_form')
{{Form::close()}}



