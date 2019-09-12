@extends('layouts.layout')

@section('title', __('messages.countries'))

@section('content')

<div class="container">

    @php
        $breadcrumbs = [
            [
                'url' => '/',
                'title' => __('messages.home'),
            ],
            [
                'url' => route('cms.countries.index'),
                'title' => __('messages.countries'),
            ],
        ];
    @endphp
    @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
    @include('countries.blocks.header.list')

    <form action="">
        @method('POST')
        @csrf
    </form>

</div>
@endsection
