
@extends('layouts.static')

@section('title', 'MoneyHelper - Возможности')

@section('navigation')
    @parent
@endsection

@section('content')
    <h1 class="center">Широкие возможности - реальная польза</h1>
    <div class="row about">
        <div class="col-sm">
            <div class="recommendations"></div>
            <h2>Рекомендации</h2>
            <p>Подскажут эффективное решение в текущей финансовой ситуации с помощью уникальной системы тахометров финансового состояния и советов.</p>
        </div>
        <div class="col-sm">
            <div class="easy-bank"></div>
            <h2>EasyBank</h2>
            <p>Загружает операции по банковским картам, экономит время на ввод операций. Список банков доступных для синхронизации данных по картам постоянно растет.</p>
        </div>
    </div>
    <div class="row about">
        <div class="col-sm">
            <div class="budget"></div>
            <h2>Бюджет</h2>
            <p>Позволяет планировать доходы и расходы, долги и кредиты, чтобы хватало денег в будущем с помощью прогнозов и мастера планирования.</p>
        </div>
        <div class="col-sm">
            <div class="goal-planning"></div>
            <h2>Планирование целей</h2>
                <p>Мотивирует в накоплении денег на желаемую покупку, помогает достичь цели быстрее.</p>
        </div>
    </div>
    <div class="row about">
        <div class="col-sm">
            <div class="calendar"></div>
            <h2>Календарь</h2>
            <p>Обеспечивает своевременность внесения повторяющихся платежей. SMS, email напоминания, синхронизация с Google calendar помогают избежать штрафов и комиссий за просрочки по платежам.</p>
        </div>
        <div class="col-sm">
            <div class="graphs"></div>
            <h2>Графики</h2>
            <p>Наглядно предсgтавляют сложную информацию в доступной форме, облегчают принятие важных финансовых решений.</p>
        </div>
    </div>
@endsection