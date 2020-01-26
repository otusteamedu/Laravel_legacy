{{-- Имя данного файла --}}
@section('pageName', 'admin.create')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Админ-панель')

@section('pageContent')
    <main>
        <p>views/pages/admin/create.blade.php</p>
        <h4>Добавить пользователя</h4>
        <form id="profile" method="POST" action="/users">
            @csrf
            <table>
                <tbody>
                <tr><td>сайт</td><td><input type="text" name="source" class="@error('source') is-invalid @enderror" value="{{ old('source') }}"></td></tr>
                <tr><td>тип</td><td><input type="text" name="type" class="@error('type') is-invalid @enderror" value="{{ old('type') }}"></td></tr>
                <tr><td>оператор</td><td><input type="text" name="operator" class="@error('operator') is-invalid @enderror" value="{{ old('operator') }}"></td></tr>
                <tr><td>ФИО</td><td><input type="text" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}"></td></tr>
                <tr><td>телефон</td><td><input type="text" name="phone" class="@error('phone') is-invalid @enderror" value="{{ old('phone') }}"></td></tr>
                <tr><td>эл.почта</td><td><input type="text" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}"></td></tr>
                <tr><td>адрес</td><td><input type="text" name="address" class="@error('address') is-invalid @enderror" value="{{ old('address') }}"></td></tr>
                </tbody>
            </table>
            <label>Комментарий
                <textarea name="comments">{{ old('comments') }}</textarea>
            </label>

            <!-- Валидация -->
            @include('blocks.errors')
            <div>
                <button type="submit" class="button primary">Сохранить</button>
            </div>
        </form>
        <br/>
        <ul class="menu" style="max-width:480px;margin:auto;">
            <li><a href="/users">&larr; Список</a></li>
        </ul>
    </main>

@endsection
