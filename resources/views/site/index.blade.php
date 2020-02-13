@php($pageTitle = 'messages.project_title')
@php($userAuthorized = false)
{{-- common page elements --}}
@extends('common.pageContent')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.pageTitle', ['pageTitle' => 'messages.page_main.title'])
@endsection
