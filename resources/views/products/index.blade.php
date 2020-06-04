@php($pageTitle = 'messages.products.title')
@php($userAuthorized = true)
{{-- common page elements --}}
@extends('common.pageContent')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.pageTitle', ['pageTitle' => 'messages.products.title'])

    <div class="container">

        {{-- @include('products.blocks.header.list') --}}
        @include('products.blocks.list.index')
    </div>
@endsection
