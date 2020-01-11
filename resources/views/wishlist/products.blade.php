@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Список желаний - {{$wishlist->name}}</h1>

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @if($errors->count())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning">{{ $error }}</div>
            @endforeach
        @endif

        {{ Form::open(['url' => route('product.store'), 'class'=>'form-inline']) }}
        {{ Form::input('text', 'product_name', '', ['class'=>'form-control', 'required']) }}
        {{ Form::hidden('wishlist_id', $wishlist->id) }}
        {{ Form::submit('+ Add new product', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}

        <div class="row">

            <table class="table table-striped custab">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                @foreach($products as $product)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><a href="{{route('product.show', $product->id)}}">{{$product->productTitle}}</a></td>
                        <td class="text-center">

                            {{ Form::open(['url' => route('wishlist-products.destroy', $product->wishlistProductsId)]) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('X', ['class' => 'btn btn-outline-secondary btn-sm']) }}
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
    </div>
@endsection
