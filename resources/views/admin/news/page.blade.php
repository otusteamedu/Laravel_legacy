@extends('admin.page')

@section('metaTitle', 'admin-news')

@section('contentWrap')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    @php
    $controllerAction = Route::currentRouteAction();
    $metodeController = explode('@',$controllerAction);
    @endphp
    @switch($metodeController[1])
        @case('index')
            @include('admin.news.index')        
        @break
        @case('create')
            @include('admin.news.create')
        @break
        @case('edit')
            @include('admin.news.edit')
        @break
            @include('admin.news.index')
        @default
    @endswitch
    
</main>
@endsection