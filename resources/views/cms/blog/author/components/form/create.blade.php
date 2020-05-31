{{ Form::open(['url' => route('cms.blog.author.create'), 'method' => 'post', 'files'=>'true']) }}

@include('cms.blog.author.components.form.fields')

{!! Form::close() !!}
