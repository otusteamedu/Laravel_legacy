@extends('public.layouts.public')

@section('pageContent')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                @yield('pageContentMain')
            </div>
            <div class="col-12 col-lg-6">
                @yield('pageContentRight')
            </div>
        </div>
    </div>
@endsection
