@php($pageTitle = 'messages.project_title')
@php($userAuthorized = false)
{{-- common page elements --}}
@extends('common.page-content')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.page-title', ['pageTitle' => 'messages.page_main.title'])
@endsection
