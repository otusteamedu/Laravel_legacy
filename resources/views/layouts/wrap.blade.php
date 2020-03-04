@extends('layouts.master')
@section('body')
    <div id="app" class="d-flex flex-column" style="height: 100vh">
        @include('blocks.header.index')
        <div class="container py-5">
            @yield('wrap')
        </div>
        @include('blocks.footer.index')
    </div>
@endsection
