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
                [
                    'url' => '/products/create',
                    'title' => __('messages.addProduct'),
                ],
            ];
        @endphp
        @include('products.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('products.blocks.header.create', ['company' => $company])
        <form>
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="title">{{ trans('messages.title') }}</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="price">{{ trans('messages.price') }}</label>
                        <input type="text" name="price" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="form-group">
                        <label for="totalCount">{{ trans('messages.totalCount') }}</label>
                        <input type="text" name="totalCount" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="{{ trans('messages.addProduct') }}" class="btn btn-success">
            </div>
        </form>
    </div>
@endsection
