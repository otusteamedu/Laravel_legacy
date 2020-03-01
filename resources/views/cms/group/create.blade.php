@extends('cms.layout')
@section('title', __('cms.group.title.create'))
@section('h1', __('cms.group.title.create'))
@section('content')
@include('cms.blocks.forms.errors')
{{Form::open(['url' => route('cms.groups.store', ['locale' => $locale]), 'method' => 'POST'])}}
@include('cms.group.blocks.form.create')
{{Form::close()}}
@endsection