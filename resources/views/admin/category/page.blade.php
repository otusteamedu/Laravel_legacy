@extends('admin.page')

@section('metaTitle', 'admin-category')

@section('contentWrap')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    @php
    $controllerAction = Route::currentRouteAction();
    $metodeController = explode('@',$controllerAction);
    @endphp
    @switch($metodeController[1])
        @case('index')
            @include('admin.category.index')        
        @break
        @case('create')
            @include('admin.category.create')
        @break
        @case('edit')
            @include('admin.category.edit')
        @break
            @include('admin.category.index')
        @default
    @endswitch
    
</main>
@endsection