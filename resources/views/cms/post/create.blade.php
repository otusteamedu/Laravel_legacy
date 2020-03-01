@extends('cms.layout')
@section('title', __('cms.post.title.create'))
@section('h1', __('cms.post.title.create'))
@section('content')
@include('cms.blocks.forms.errors')
{{Form::open([
    'url' => route('cms.posts.store', ['locale' => $locale]),
    'method' => 'POST',
    'files' => true
])}}
@include('cms.post.blocks.form.create')
{{Form::close()}}
@endsection