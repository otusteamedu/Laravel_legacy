@extends('admin.layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">{{__('dashboard.products')}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-md btn-outline-secondary" href="{{ route('admin.product.create',['locale'=>app()->getLocale()])}}" role="button">{{__('dashboard.product.add')}}</a>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $key=>$item)
            <tr>
                <th scope="row">
                @php
                    echo (($key+1)+$products->perPage()*($products->currentPage()-1));
                @endphp
                </th>
                <td><a href="{{ route('admin.product.edit',['product'=>$item->id,'locale'=>app()->getLocale()])}}">{{$item->name}}</a></td>
                <td>{{$item->price}}&nbsp;&#8381;</td>
                <td>{{$item->category->name}}</td>
{{--                <td>{{$category[$item->category_id]}}</td>--}}
                <td>{{$item->description}}</td>
                <td>
                    <a class="btn btn-link" href="{{route('admin.product.edit',['product'=>$item->id,'locale'=>app()->getLocale()])}}" role="button">{{__('dashboard.edit')}}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$products->links()}}
@endsection
