@extends('cms.layout')
@section('title', __('cms.page.title.create'))
@section('h1', __('cms.page.title.create'))
@section('content')
@include('cms.blocks.forms.errors')
{{Form::open(['url' => route('cms.pages.store'), 'method' => 'POST'])}}
@include('cms.page.blocks.form.create')
{{Form::close()}}
@endsection