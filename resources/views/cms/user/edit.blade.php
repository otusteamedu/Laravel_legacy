@extends('cms.layout')
@section('title', __('cms.user.title.edit'))
@section('h1', __('cms.user.title.edit'))
@section('content')
@include('cms.blocks.forms.errors')
<?php /** @var \App\Models\User\User $user */ ?>
{{Form::open([
    'url' => route('cms.users.update', ['user' => $user->id]),
    'method'=>'PUT',
    'files' => true
])}}
@include('cms.user.blocks.form.edit')
{{Form::close()}}
@endsection