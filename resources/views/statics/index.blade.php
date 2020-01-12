
@extends('layouts.static')

@section('title', 'MoneyHelper - система управления личными финансами')

@section('content')
    <div class="row index">
        <div class="col-sm">
            <h1 class="color-white">ДЕНЬГИ<br/>
                ЛЮБЯТ<br/>
                СЧЕТ</h1>
            <p class="color-white">Учет личных финансов, импорт и синхронизация операций
                из более 200 банков 10 стран, включая Россию.
                Ваш финансовый навигатор в браузере и смартфоне.
                Планирование бюджета семьи и малого бизнеса.
                Это больше, чем просто домашняя бухгалтерия.</p>
            <a href="{{route('home')}}">Начните сейчас</a>
        </div>
        <div class="col-sm right">
            <p class="color-white">Поделитесь с друзьями</p>
            <ul class="social justify-content-end">
                <li>
                    <a href="#"><i class="fab fa-facebook-square fa-3x"></i></a>
                <li>
                    <a href="#"><i class="fab fa-vk fa-3x"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fab fa-twitter-square fa-3x"></i></a></li>
                </li>
                <li>
                    <a href="#"><i class="fab fa-odnoklassniki-square fa-3x"></i></a>
                </li>
                <li>
                    <a href="#"><i class="fab fa-google-plus-square fa-3x"></i></a>
                </li>
            </ul>
        </div>
    </div>
@endsection