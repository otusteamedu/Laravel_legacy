{{-- Имя данного файла --}}
@section('pageName', 'login')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Интернет-магазин фруктов')

@section('pageContent')
    <main>    
        <p>/login</p>
        <h4>Вход</h4>
        <p>на сайт</p>
        <form>
            <label>Ваш телефон</label>
            <input type="text" placeholder="+79528900108" name="phone">
            <label>Ваш пароль</label>
            <input type="text" placeholder="" name="password">
            <div><button class="button" type="submit">Войти</button></div>
        </form>        
        <br/>
        <p>Я зарегистрирован. <a href="/login">Войти</a></p>
  
    </main>
    
@endsection
