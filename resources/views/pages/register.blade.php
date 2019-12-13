{{-- Имя данного файла --}}
@section('pageName', 'register')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Интернет-магазин фруктов')

@section('pageContent')
    <main>    
        <p>/register</p>
        <h4>Регистрация</h4>
        <p>пользователя</p>
        <form>
            <label>Как Вас зовут ?</label>
            <input type="text" placeholder="Иванов Иван Иванович" name="name">
            <label>Ваш телефон</label>
            <input type="text" placeholder="+79528900108" name="phone">
            <label>Придумайте пароль</label>
            <input type="text" placeholder="" name="password">
            <label>Подтвердите пароль</label>
            <input type="text" placeholder="" name="password-confirm">
            <div><button class="button" type="submit">Зарегистрироваться</button></div>
        </form>        
        <br/>
        <p>Я зарегистрирован. <a href="/login">Войти</a></p>
  
    </main>
    
@endsection
