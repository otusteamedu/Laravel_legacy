@extends('cms.layout')
@section('title', __('cms.user.title.create'))
@section('h1', __('cms.user.title.create'))
@section('content')
@include('cms.blocks.forms.errors')
{{Form::open([
    'url' => route('cms.users.store'),
    'method' => 'POST',
    'files' => true,
])}}
@include('cms.user.blocks.form.create')
{{Form::close()}}
@endsection