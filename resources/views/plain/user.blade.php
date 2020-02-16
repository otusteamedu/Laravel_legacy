@extends('plain.layout')

@section('header-styles')
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="css/big-sale.css">
    <link rel="stylesheet" href="css/base-laravel-style.css">
@endsection

@section('header-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/jquery.arcticmodal-0.3.min.js"></script>
    <script src="js/inputmask.min.js"></script>
    <script src="https://yastatic.net/share2/share.js" async="async"></script>
    <script src="js/big-sale.js"></script>
@endsection

@section('title')
    Личный кабинет
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Личный кабинет</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                <div class="edit-data-form">
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputName" class="control-label col-xs-2">Имя</label>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Иван">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="control-label col-xs-2">Телефон</label>
                                <div class="col-xs-10">
                                    <input type="tel" class="form-control" id="inputName" placeholder="+7 (999) 123-45-67">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="control-label col-xs-2">email</label>
                                <div class="col-xs-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="name@mail.ru">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword" class="control-label col-xs-2">Пароль</label>
                                <div class="col-xs-10">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Пароль">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPasswordRetype" class="control-label col-xs-2">Текущй пароль</label>
                                <div class="col-xs-10">
                                    <input type="password" class="form-control" id="inputPasswordRetype" placeholder="Пароль">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
