@extends('main.layout')

@section('favicon')
    {{ Html::favicon( '/images/favicon.png' ) }}
@endsection

@section('title', __('messages.mainTitle'))

@section('style')
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md main-title">
                {{__('messages.mainTitle')}}
            </div>

            <div class="links">
                <a href="/">{{__('messages.main')}}</a>
                <a href="/register">{{__('messages.registration')}}</a>
                <a href="/user">{{__('messages.userPage')}}</a>
                <a href="/helps">{{__('messages.referenceInformation')}}</a>
            </div>
        </div>
    </div>
@endsection