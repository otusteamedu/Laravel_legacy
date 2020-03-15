<?php /** @var \App\Models\Page\Page $page */?>
@extends('portal.layout')
@section('title', $page->title)
@section('description', $page->description)
@section('keywords', $page->keywords)
@section('h1', $page->name)
@section('content')
    <h1>@yield('h1')</h1>
    {{$page->content}}
@endsection