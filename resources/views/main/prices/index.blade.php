@extends('layouts.main.index')

<?php
$arPrices = Array(
    Array(
        "name" => "Bronze",
        "props" => Array(
            "count_of_accounts" => [
                "name" => "Количество аккаунтов",
                "value" => 1
            ],
            "proxy" => [
                "name" => "Использование proxy",
                "value" => "Да"
            ],
            "watermark" => [
                "name" => "Наложение водяного знака",
                "value" => "Да"
            ],
            "posts_per_day" => [
                "name" => "Количество постов в день",
                "value" => 10
            ]
        ),
        "price" => 0
    ),
    Array(
        "name" => "Bronze",
        "props" => Array(
            "count_of_accounts" => [
                "name" => "Количество аккаунтов",
                "value" => 10
            ],
            "proxy" => [
                "name" => "Использование proxy",
                "value" => "Да"
            ],
            "watermark" => [
                "name" => "Наложение водяного знака",
                "value" => "Да"
            ],
            "posts_per_day" => [
                "name" => "Количество постов в день",
                "value" => 60
            ]
        ),
        "price" => 30
    ),
    Array(
        "name" => "Bronze",
        "props" => Array(
            "count_of_accounts" => [
                "name" => "Количество аккаунтов",
                "value" => 100
            ],
            "proxy" => [
                "name" => "Использование proxy",
                "value" => "Да"
            ],
            "watermark" => [
                "name" => "Наложение водяного знака",
                "value" => "Да"
            ],
            "posts_per_day" => [
                "name" => "Количество постов в день",
                "value" => 1000
            ]
        ),
        "price" => 300
    ),
);
?>

@section('content')
    <div class="container">
        <div class="content">
            <h1>Цены</h1>
            <div class="row">
                @foreach($arPrices as $arPrice)
                    <div class="col-4 price-item__wrap">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        {{ $arPrice["name"]  }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($arPrice["props"] as $arProp)
                                    <tr class="price-item__description">
                                        <td>
                                            {{ $arProp["name"] }}: {{ $arProp["value"]  }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tr class="table-primary price-item__price">
                                <td>{{ $arPrice["price"] == 0 ? 'free' : ($arPrice["price"] . "руб.") }}</td>
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
