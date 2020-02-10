@extends('layouts.main.index')

@section('content')
    <div class="container">
        <div class="content">
            <div class="personal-card">
                <div class="row">
                    <div class="col-md-3 personal-card__left">
                        <div class="personal-card__image-wrap">
                            <img class="personal-card__image" src="/storage/user.jpg" alt="">
                            <button class="btn btn-primary">Изменить фото</button>
                        </div>
                    </div>
                    <div class="col-md-9 personal-card__left-right">
                        <h1>Вячеслав Шевченко</h1>
                        <table class="table">
                            <tr>
                                <td>Ваш тариф:</td>
                                <td>Gold</td>
                            </tr>
                            <tr>
                                <td>Количество постов за этот месяц:</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Остаток на счете:</td>
                                <td>1000 руб.</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
