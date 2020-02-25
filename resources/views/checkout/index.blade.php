@extends('checkout.layout')

@section('styles')
    <style>


    </style>
@endsection
@section('content')
    @include('checkout.blocks.header')

    <div class="row">
        @include('checkout.blocks.rightcart')
        @include('checkout.blocks.form')

    </div>

    @include('checkout.blocks.footer')
    {{--    <script src="{{ mix('/js/app.js') }}"></script>--}}
    {{--    <script src="form-validation.js"></script>--}}
@endsection



