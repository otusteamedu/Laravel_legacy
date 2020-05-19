@extends('layouts.initial')
@php
    // SOME INITIAL DATA

    $items = [
        [
            "name" => __('cf.exercise'),
            "url" => "exercise"
        ],
        [
            "name" => __('cf.complex'),
            "url" => "complex"
        ],
            [
            "name" => __('cf.enter'),
            "url" => "register"
        ]
    ];

    $randomtext = "Коллективное бессознательное, несмотря на внешние воздействия, косвенно. Компульсивность параллельна. Чувство, в представлении Морено, релевантно иллюстрирует архетип.
Сознание осознаёт филосовский онтогенез речи. Эриксоновский гипноз традиционен. Онтогенез речи, конечно, теоретически возможен.
Компульсивность вероятна. Аутизм понимает инсайт. Гештальт слабопроницаем.";


@endphp
@section('title')
@lang('cf.main_title')
@endsection

@section('nav')
@include('blocks.nav.navbar')
@endsection

@section('content')

    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <br><br>
            <h1 class="header center orange-text">@lang('cf.welcome')</h1>
            <div class="row center">
                <h5 class="header col s12 light">@lang('cf.description')</h5>
            </div>
            <div class="row center">

                @include('blocks.buttons.large', [
                "url" => "#",
                "text" => __('cf.start')])
            </div>
            <br><br>

        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="row">
            <div class="col s12 m4">

                @include('blocks.cards.card', [
                                "image" => "images/1.jpg",
                                "text" => $randomtext,
                                "title" => __('cf.exercise')
                                ])

            </div>

            <div class="col s12 m4">
                @include('blocks.cards.card', [
                                     "image" => "images/2.jpg",
                                     "text" => $randomtext,
                                     "title" => __('cf.complex')
                                     ])
            </div>

            <div class="col s12 m4">
                @include('blocks.cards.card', [
                                     "image" => "images/3.jpg",
                                     "text" => $randomtext,
                                     "title" => __('cf.name')
                                     ])
            </div>


</div>
        </div>
    </div>



@endsection


@section('footer')
    <footer class="page-footer orange">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    @lang('cf.temp')

                </div>

            </div>
            <div class="col l3 s12">

            </div>
        </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
            </div>
        </div>
    </footer>
@endsection