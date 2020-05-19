@extends('pages.index')
@php
    // SOME INITIAL DATA

    $complex = [
    "text" => "CINDY",
    ];

$cindy = [
    "image" => "images/cindy.jpeg",
    "title" => "Описание комплекса",
    "text" => "<p><strong>Задание:</strong></p>
<ol>
<li>5 подтягиваний</li>
<li>10 отжиманий</li>
<li>15 приседаний</li>
</ol>
",
    "links" => [
        "0" =>[
            "url" => "#",
            "text" => "Пройти!"
            ]
            ]

];

$second = [
"text" => "<p><strong>Кругов:</strong> Максимальное количество за 20 минут</p>
<p><strong>Тип тренировки:</strong> Гимнастика</p>
<p><strong>Требуется:</strong> Турник</p>
<p><strong>Нормативы:</strong></p>
<p>Новичок: 7 кругов<br />
Средний уровень: 14 кругов<br />
Уровень атлета: 21 круг<br />
80 уровень: 27 кругов</p>"
];

@endphp
@section('content')
    <div class="container">

        <div class="row">

            <div class="col s12">@include('blocks.cards.hugecard',["text" => $complex['text']])
            </div>

        </div>

        <div class="row">
            <div class="col s6">
                @include('blocks.cards.card',[
                        "image" => $cindy['image'],
                        "text" => $cindy['text'],
                                "title" => $cindy['title'],
                                "links" => $cindy['links']])
            </div>
            <div class="col s6">
    @include('blocks.cards.cardpanel',["text" => $second['text']])
                @include('blocks.cards.card',
                                    ["text" => "<ul>
    <li>1. Семен</li>
    <li>2. Игорь</li>
    <li>3. Гена</li>

    </ul>",
                                     "title" => "Топ атлетов"])
</div>

</div>

</div>



@endsection

@push('scripts')

@endpush