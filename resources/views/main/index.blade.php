@extends('layouts.welcome')

@section('welcome_content')
    <div class="container text-center">
        <h1>@lang('scheduler.name')</h1>
        <br>
        <div class="content">
            <div class="card h5">
                <div class="card-body">
                    <h2>Сервис для предоставления студентам доступа:</h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">к расписанию</li>
                        <li class="list-group-item">рабочим программам</li>
                        <li class="list-group-item">учебному плану</li>
                    </ul>
                    <h2>Через платформу — Telegram</h2>
                </div>
            </div>
            <br>
            <h2>Возможности сервиса:</h2>
            <div class="card h4">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item active">Сервис для предоставления студентам доступа к учебному расписанию:</li>
                        <li class="list-group-item">посмотреть свое расписание на определенную дату</li>
                        <li class="list-group-item">посмотреть все свои предметы</li>
                        <li class="list-group-item">посмотреть своего преподавателя по предмету</li>
                        <li class="list-group-item">посмотреть список тем по предмету для лекция, практик</li>
                        <li class="list-group-item">посмотреть данные по определенной теме</li>
                        <li class="list-group-item">посмотреть список консультаций преподавателя по предмету</li>
                        <li class="list-group-item">записаться на консультацию при наличии мест</li>
                        <li class="list-group-item">подписаться на объявления от преподавателя</li>
                    </ul>
                </div>
            </div>
            <div class="card h4">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item active">Для учебно-методического отдела:</li>
                        <li class="list-group-item">работать с учебными группами</li>
                        <li class="list-group-item">работать с отдельными студентами</li>
                        <li class="list-group-item">работать с преподавателями</li>
                        <li class="list-group-item">работать с предметами</li>
                        <li class="list-group-item">распределение преподавателей по предметам</li>
                        <li class="list-group-item">распределение студентов по группам</li>
                        <li class="list-group-item">составление учебных планов</li>
                        <li class="list-group-item">составление расписания занятий и консультаций</li>
                    </ul>
                </div>
            </div>
            <div class="card h4">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item active">Для педагогического состава:</li>
                        <li class="list-group-item">разработка рабочих программ по предметам</li>
                        <li class="list-group-item">разработка лекций</li>
                        <li class="list-group-item">назначение консультаций с возможностью ограничивать запись на них</li>
                        <li class="list-group-item">создание объявлений для своих студентов / предметов</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2">
            @include('blocks.pages.feedback')
        </div>
    </div>
@endsection
