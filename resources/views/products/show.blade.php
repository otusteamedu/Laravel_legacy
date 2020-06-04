@php($pageTitle = 'messages.products.title')
@php($userAuthorized = true)
{{-- common page elements --}}
@extends('common.pageContent')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.pageTitle', ['pageTitle' => 'messages.products.title'])

    <div class="container">

        {{-- @include('products.blocks.header.show', ['product' => $product]) --}}
        {{-- @include('products.blocks.products-list.index', ['product' => $product, 'products' => $products]) --}} {{-- TODO this is product images --}}
    </div>
@endsection
