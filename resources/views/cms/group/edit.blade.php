@extends('cms.layout')
@section('title', __('cms.group.title.edit'))
@section('h1', __('cms.group.title.edit'))
@section('content')
@include('cms.blocks.forms.errors')
<?php /** @var App\Models\User\Group $group */ ?>
{{Form::open(['url' => route('cms.groups.update', ['group' => $group->id, 'locale' => $locale]), 'method'=>'PUT'])}}
@include('cms.group.blocks.form.edit')
{{Form::close()}}
@endsection