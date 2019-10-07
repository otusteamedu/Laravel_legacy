@extends('layouts.layout')

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
                    'url' => '/companies',
                    'title' => __('messages.companies'),
                ],
                [
                    'url' => '/companies/create',
                    'title' => __('messages.addProduct'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('countries.blocks.header.edit')
        @include('countries.blocks.form.edit')
    </div>
@endsection
