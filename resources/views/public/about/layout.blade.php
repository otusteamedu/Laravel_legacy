@extends('public.layouts.public')

@section('pageContent')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                @yield('pageContentMain')
            </div>
            <div class="col-12 col-lg-4">
                @yield('pageContentRight')
            </div>
        </div>
    </div>
@endsection
