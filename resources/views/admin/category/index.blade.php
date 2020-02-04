@extends('admin.layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Categories products</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a class="btn btn-md btn-outline-secondary" href="{{ route('admin.category.create')}}" role="button">Add category</a>
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
            <th scope="col">Category Name</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($category as $key=>$item)
            <tr>
                <th scope="row">
                    @php
                        if($category->currentPage() == 2){
                            echo ($key+$category->perPage()+1);
                        }else{
                            echo $key+1;
                        }
                    @endphp
                </th>
                <td><a href="{{ route('admin.category.edit',[$item->id])}}">{{$item->name}}</a></td>
                <td>{{$item->description}}</td>
                <td>
                    <a class="btn btn-link" href="{{route('admin.category.edit',[$item->id])}}" role="button">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
