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
    Регистрация нового пользователя
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Регистрация нового пользователя</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                <div class="registration-form">
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputName" class="control-label col-xs-2">Имя</label>
                                <div class="col-xs-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Иван">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="control-label col-xs-2">Телефон</label>
                                <div class="col-xs-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="+7 (999) 123-45-67">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
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
