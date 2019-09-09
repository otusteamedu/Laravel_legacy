@extends('helps.layout')

@section('favicon')
{{ Html::favicon( '/images/favicon.png' ) }}
@endsection

@section('title', __('messages.referenceInformation'))

@section('style')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{__('messages.referenceInformation')}}
            </div>

            <div class="links">
                <a href="/">{{__('messages.main')}}</a>
                <a href="/register">{{__('messages.registration')}}</a>
                <a href="/user">{{__('messages.userPage')}}</a>
                <a href="/helps">{{__('messages.referenceInformation')}}</a>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="title m-b-md">
            <a href="https://tlgrm.ru/docs/bots" class="text-xl-left" target="_blank">1. Роботы: информация для разработчиков (telegram API)</a>
        </div>
        <div class="title m-b-md">
            <a href="https://habr.com/ru/post/347482/" class="text-xl-left" target="_blank">2. Диалоговый телеграм бот на PHP (Habr)</a>
        </div>
        <div class="title m-b-md">
            <a href="https://habr.com/ru/post/347482/" class="text-xl-left" target="_blank">3. Бот для telegram на php. Отложенный постинг, кнопки, инлайн-запросы (Habr)</a>
        </div>
    </div>
@endsection