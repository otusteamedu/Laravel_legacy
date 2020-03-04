@extends('layouts.wrap')
@section('wrap')
    <div class="row">
        <div class="col-12">
            @include('blocks.breadcrumb.index')
        </div>
        <div class="col">
            @yield('content')
        </div>
        <div class="col-3 d-none d-md-block">
            @yield('sidebar')
        </div>
    </div>
@endsection
