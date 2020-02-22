@extends('layouts.master')
@section('body')
    <div id="app" class="d-flex flex-column" style="height: 100vh">
        @include('blocks.header.index')
        <div class="container py-5">
            <div class="row">
                <div class="col-12 mb-3 col-md-3 mb-md-0">
                    @yield('sidebar')
                </div>
                <div class="col">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('blocks.footer.index')
    </div>
@endsection
