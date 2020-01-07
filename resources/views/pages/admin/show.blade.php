{{-- Имя данного файла --}}
@section('pageName', 'admin.show')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Админ-панель')

@section('pageContent')
    <main>
        <p class="center">/admin/show</p>
        <h4>Карточка пользователя</h4>
        <div id="data">
            <table>
                <tbody>
                    <tr><td>id</td><td>{{$user->id}}</td></tr>
                    <tr><td>сайт</td><td>{{$user->source}}</td></tr>
                    <tr><td>тип</td><td>{{$user->type}}</td></tr>
                    <tr><td>оператор</td><td>{{$user->operator}}</td></tr>
                    <tr><td>ФИО</td><td>{{$user->name}}</td></tr>
                    <tr><td>телефон</td><td>{{$user->phone}}</td></tr>
                    <tr><td>эл.почта</td><td>{{$user->email}}</td></tr>
                    <tr><td>адрес</td><td>{{$user->address}}</td></tr>
                </tbody>
            </table>
            <label>Комментарий
                <textarea disabled>{{$user->comments}}</textarea>
            </label>
        </div>
        <br/>
        @include('blocks/admin-navigation')
    </main>

@endsection
