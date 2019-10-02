@extends('layouts.app')

@section('content')

<div class="jumbotron" style="background: #65c4d0">
    <div class="container text-white">
        <div class="row">
            <div class="col-md-6">
                <h1 class="display-5">Коллеги!</h1>
                <p>
                    Это платформа с разными каналами общения с клиентами: email, web push уведомления, SMS и Viber рассылки. Можно отправлять различные типы сообщений отдельно или комбинировать их в авторассылки.
                </p>
            </div>
            @guest
                <div class="col-md-6">
                    @include('parts.login_part')
                </div>
            @else

            @endif
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
                    <div class="col-md-4">
                        <h2>Адресные книги</h2>
                        <p>Создавайте адресные книги или используйте готовые корпоративные справочники.</p>
                    </div>
                    <div class="col-md-4">
                        <h2>Смарт группы</h2>
                        <p>Смарт группы контактов позволяют отправлять письма контактам по определенному признаку.</p>
                    </div>
                    <div class="col-md-4">
                        <h2>Конструктор</h2>
                        <p>Констркутор шаблонов позволит Вам без специальных знаний собрать рассылку по коллегам или клиентам.</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<div class="jumbotron" style="background: #eee;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">

asdfasdf

            </div>
        </div>
    </div>
</div>


@endsection
