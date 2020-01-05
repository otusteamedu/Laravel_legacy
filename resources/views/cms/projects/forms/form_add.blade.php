{{ Form::open(['url' => route('csm.projects.store')]) }}
@include('cms.projects.forms.fields_form')
{{Form::close()}}



