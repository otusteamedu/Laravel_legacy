@extends('user.layout')

@section('favicon')
    {{ Html::favicon( '/images/favicon.png' ) }}
@endsection

@section('title', __('messages.userPage'))

@section('style')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md main-title">
                {{__('messages.userPage')}}
            </div>

            <div class="links">
                <a href="/">{{__('messages.main')}}</a>
                <a href="/register">{{__('messages.registration')}}</a>
                <a href="/user">{{__('messages.userPage')}}</a>
                <a href="/helps">{{__('messages.referenceInformation')}}</a>
            </div>
        </div>
    </div>
    <div class="text-center">
        <img src="{{asset('images/telegram_photo.png')}}" class="rounded" alt="...">
    </div>
@endsection