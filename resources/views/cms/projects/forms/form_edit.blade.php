{{ Form::model($project, ['route' => ['csm.projects.update',$project->id, 'lang' => app()->getLocale()],'method' => 'PUT']) }}
@include('cms.projects.forms.fields_form')
{{Form::close()}}



