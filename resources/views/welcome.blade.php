@extends('layouts.base')

@section('title', __('menu.welcome'))

@section('content')

    <div class="container mainpage">
        <div class="content">
            <div class="title m-b-md">
                Добро пожаловать! Welcome!
            </div>

            <div class="links">
                <a href="/ru">Русский</a>
                <a href="/en">English</a>
            </div>
        </div>
    </div>
@endsection
