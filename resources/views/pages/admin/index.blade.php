{{-- Имя данного файла --}}
@section('pageName', 'admin.index')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Админ-панель')

@section('pageContent')
    <main>
        <p>views/pages/admin/index.blade.php</p>
        <div><img src="../img/admin.png"></div>
        <h4>Пользователи</h4>
        <p class="center"><a href="/users/create">+ Новый пользователь</a></p>
        @if(count($users)>0)
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Тип</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Сайт</th>
                        <th>Оператор</th>
                        <th>Детали</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users->all() as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->type}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->source}}</td>
                        <td>{{$user->operator}}</td>
                        <td><a href="/users/{{$user->id}}">смотреть</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Пользователей нет.</p>
        @endif

    </main>

@endsection
