@extends('products.layout')

@section('title', __('messages.products'))

@section('content')

<div class="container">

    @php
        $breadcrumbs = [
            [
                'url' => '/',
                'title' => __('messages.home'),
            ],
            [
                'url' => $company['url'],
                'title' => $company['name'],
            ],
            [
                'url' => '/products',
                'title' => __('messages.products'),
            ],
        ];
    @endphp
    @include('products.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
    @include('products.blocks.header.index', ['company' => $company])
    @include('products.blocks.list.index', ['products' => $products])
</div>
@endsection
