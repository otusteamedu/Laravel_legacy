@extends('admin.page')

@section('metaTitle', 'admin-user')

@section('contentWrap')
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    @php
    $controllerAction = Route::currentRouteAction();
    $metodeController = explode('@',$controllerAction);
    @endphp
    @switch($metodeController[1])
        @case('index')
            @include('admin.user.index')        
        @break
        @case('create')
            @include('admin.user.create')
        @break
        @case('edit')
            @include('admin.user.edit')
        @break
            @include('admin.user.index')
        @default
    @endswitch
    
</main>
@endsection