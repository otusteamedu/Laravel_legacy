@extends('cms.layout')
@section('title', __('cms.page.title.edit'))
@section('h1', __('cms.page.title.edit'))
@section('content')
@include('cms.blocks.forms.errors')
<?php /** @var \App\Models\Page\Page $page */ ?>
{{Form::open(['url' => route('cms.pages.update', ['page' => $page->id]),'method'=>'PUT'])}}
@include('cms.page.blocks.form.edit')
{{Form::close()}}
@endsection