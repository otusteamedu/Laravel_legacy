@php($pageTitle = 'messages.categories.title')
@php($userAuthorized = true)
{{-- common page elements --}}
@extends('common.pageContent')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.pageTitle', ['pageTitle' => 'messages.categories.add'])

    <div class="container">

        @include('categories.blocks.form.create')
    </div>
@endsection
