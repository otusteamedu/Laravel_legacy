@extends('cms.layout')
@section('title', __('cms.rubric.title.edit'))
@section('h1', __('cms.rubric.title.edit'))
@section('content')
@include('cms.blocks.forms.errors')
<?php /** @var \App\Models\Post\Rubric $rubric */ ?>
{{Form::open(['url' => route('cms.rubrics.update', ['rubric' => $rubric->id, 'locale' => $locale]), 'method'=>'PUT'])}}
@include('cms.rubric.blocks.form.edit')
{{Form::close()}}
@endsection