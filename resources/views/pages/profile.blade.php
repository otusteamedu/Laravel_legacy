{{-- Имя данного файла --}}
@section('pageName', 'profile')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Интернет-магазин фруктов')

@section('pageContent')
    <main>
        <p>/profile</p>
        <h4>Мой профиль</h4>
        <form id="profile" method="POST" action="/users">
            @csrf
            <table>
                <tbody>
                <tr><td>ФИО</td><td><input type="text" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}"></td></tr>
                <tr><td>телефон</td><td><input type="text" name="phone" class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}"></td></tr>
                <tr><td>эл.почта</td><td><input type="text" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}"></td></tr>
                <tr><td>адрес</td><td><input type="text" name="address" class="@error('address') is-invalid @enderror" value="{{ old('address') }}"></td></tr>
                </tbody>
            </table>
            <!-- Валидация -->
            @include('blocks.errors')
            <div>
                <button type="submit" class="button primary">Сохранить</button>
            </div>
        </form>

        <br/>
        <p><a href="/logout">Выйти</a></p>

    </main>

@endsection
