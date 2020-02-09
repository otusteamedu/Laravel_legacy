@extends('cms.layout')
@section('title', __('cms.post.title.edit'))
@section('h1', __('cms.post.title.edit'))
@section('content')
@include('cms.blocks.forms.errors')
<?php /** @var \App\Models\Post\Post $post */ ?>
{{Form::open([
    'url' => route('cms.posts.update', ['post' => $post->id]),
    'method'=>'PUT',
    'files' => true
])}}
@include('cms.post.blocks.form.edit')
{{Form::close()}}
@endsection