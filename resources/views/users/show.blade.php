@extends('plain.layout')

@section('header-styles')
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="../../css/big-sale.css">
    <link rel="stylesheet" href="../../css/base-laravel-style.css">
@endsection

@section('header-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../../js/jquery.arcticmodal-0.3.min.js"></script>
    <script src="../../js/inputmask.min.js"></script>
    <script src="https://yastatic.net/share2/share.js" async="async"></script>
    <script src="../../js/big-sale.js"></script>
@endsection

@section('title')
    Список пользователей
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Список пользователей</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                <div class="edit-data-form">
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputName" class="control-label col-xs-2">Название страны</label>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Россия">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="control-label col-xs-2">Континент</label>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" id="inputContinentName" placeholder="Евразия">
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
