{{-- Имя данного файла --}}
@section('pageName', 'home')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Интернет-магазин фруктов')

@section('pageContent')
    <main>    
        <p>/home</p>
        <div><img src="img/minion.svg"></div>
        <h4>Личный кабинет</h4>
        <p>пользователя</p>
        <form id="profile" method="POST" action="users/{{$user->id}}">
            @csrf
            @method('PATCH')

            <div>
                <label>Ваше имя</label>
                <input type="text" name="fio" class="{{$errors->has('fio')?'red-border':''}}" value="{{ old('fio') }}">
            </div>

            <div>
                <label>Ваш телефон № 1</label>
                <input type="text" name="phone1" class="{{$errors->has('phone1')?'red-border':''}}" value="{{ old('phone1') }}">
            </div>

            <div>
                <label>Ваш телефон № 2</label>
                <input type="text" name="phone2" class="{{$errors->has('phone2')?'red-border':''}}" value="{{ old('phone2') }}">
            </div>
        
            <div>
                <label>Электронная почта</label>
                <input type="email" name="email" class="{{$errors->has('email')?'red-border':''}}" value="{{ old('email') }}">
            </div>

            <div>
                <label>Адрес доставки</label>
                <textarea name="address" class="{{$errors->has('address')?'red-border':''}}">{{ old('address') }}</textarea>
            <div>
        
            <!-- Валидация -->
            @include('blocks.errors')

            <div class="center">
                <button type="submit" class="button primary">Сохранить изменения</button>
            </div>
            
            <div class="center">
                <a href="users.destroy">Удалить мой акаунт</a>
            </div>            

        </form>      
  
    </main>
    
@endsection
