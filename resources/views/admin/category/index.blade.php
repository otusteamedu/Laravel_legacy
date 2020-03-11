@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">{{__('dashboard.category')}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-md btn-outline-secondary"
                   href="{{ route('admin.category.create',['locale'=>app()->getLocale()])}}" role="button">{{__('dashboard.category.add')}}</a>
            </div>
        </div>
    </div>
    @isset($ok)
        <p>создал</p>
    @endisset
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('dashboard.category.name')}}</th>
            <th scope="col">{{__('dashboard.description')}}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($category as $key=>$item)
            <tr>
                <th scope="row">
                    @php
                        echo (($key+1)+$category->perPage()*($category->currentPage()-1));
                    @endphp
                </th>
                <td><a href="{{ route('admin.category.edit',['category'=>$item->id,'locale'=>app()->getLocale()])}}">{{$item->name}}</a></td>
                <td>{{$item->description}}</td>
                <td>
                    <a class="btn btn-link" href="{{route('admin.category.edit',['category'=>$item->id,'locale'=>app()->getLocale()])}}" role="button">{{__('dashboard.edit')}}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
