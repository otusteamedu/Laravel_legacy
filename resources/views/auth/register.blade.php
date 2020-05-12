
@extends('layouts.app')


@section('title', 'Регистрация')

@section('content')

<div class="container ">
    <div class="row justify-content-center">
        <h1 class="mt-5">Регистрация нового пользователя</h1>
    </div>
    <div class="row justify-content-center">
        <form>
            <div class="form-group mt-5">
                <label for="exampleInputEmail1">Email адрес(логин)</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Подтвердить пароль</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
</div>


@endsection
