@extends('cms.layout')
@section('title', __('cms.rubric.title.create'))
@section('h1', __('cms.rubric.title.create'))
@section('content')
@include('cms.blocks.forms.errors')
{{Form::open(['url' => route('cms.rubrics.store'), 'method' => 'POST'])}}
@include('cms.rubric.blocks.form.create')
{{Form::close()}}
@endsection