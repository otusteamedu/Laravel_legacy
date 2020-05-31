{{ Form::open([
    'url' => route('cms.blog.author.edit', ['author' => $author]),
    'method' => 'post',
    'files'=>'true'
]) }}

@include('cms.blog.author.components.form.fields', ['author' => $author])

{!! Form::close() !!}
