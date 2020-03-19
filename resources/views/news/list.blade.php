@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-deck">
            @for($i = 1; $i <= 3; ++$i)
            <div class="card">
                <img class="card-img-top" src="https://via.placeholder.com/362x180" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Заголовок {{ $i }}</h5>
                    <p>Задача организации, в особенности же начало повседневной работы по формированию позиции позволяет оценить значение новых предложений.</p>
                    <p>Равным образом рамки и место обучения кадров позволяет оценить значение дальнейших направлений развития.</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Обновлена одну минуту назад</small>
                </div>
            </div>
            @endfor
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        @include('blocks.pagination.default')
    </div>
</div>


@endsection
