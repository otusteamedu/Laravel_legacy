@extends('pages.index')
@php
    // SOME INITIAL DATA

    $exercise = [
    "title" => "KB Swing",
    "image" => "images/kb-swing.jpg",
    "description" => "Махи гирей — составное упражнение, часто использующееся в кроссфит программах. Для его выполнения вам понадобится гиря, вес которой будет зависеть от уровня вашей подготовленности. При его выполнении задействовано множество мышечных групп: бедра, спину, ягодичные, икроножные и дельтовидные мышцы. Махи гирей могут выполняться как двумя руками, так и одной рукой поочередно.

Если вы наблюдаете, как многие люди делают махи гирей, вы можете думать, что дело в том, чтобы просто поднять вес вверх. Но махи гирей сосредоточены на самом деле не на поднятии гири. Гиря просто реагирует на движение вашего тела.",

    ];

    $atletes= "<ul>
    <li>1. Семен</li>
    <li>2. Игорь</li>
    <li>3. Гена</li>

    </ul>";


@endphp
@section('content')
    <div class="container">

        <div class="row">

            <div class="col s8">@include('blocks.cards.card',
                                    ["text" => $exercise['description'],
                                     "title" => $exercise['title']])
            </div>
            <div class="col s4">
                <div class="card-panel">
                    <img class="materialboxed responsive-img" src="{{ $exercise['image'] }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s6">@include('blocks.cards.card',
                                    ["text" => $exercise['description'],
                                     "title" => "Рекомендации"])
            </div>
            <div class="col s6">@include('blocks.cards.card',
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
    document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.materialboxed');
            var instances = M.Materialbox.init(elems);
    });
@endpush