@extends('layouts.contacts')
@section('header')
    @include('blocks.header.header')
@endsection
@section('content')
<div class="wrapper">
    <h1>Контактная форма</h1>
    <p class="descrip">Если у вас есть вопрос, заполните пожалуйста это форму.</p>
</div>
<div class="wrapper">
    <form class="contactame" method="post" action="#">
        <fieldset class="nine"> <label>Имя</label>
            <input type="text" name="dtname" required="">
        </fieldset>
        <fieldset class="nine fix">
            <label>Email</label>
            <input type="text" name="email" required="">
        </fieldset>
        <fieldset>
            <label>Вопрос</label>
            <p>Чем мы можем помочь?</p>
            <input type="text" name="asunto" required="">
        </fieldset>
        <fieldset>
             <label>Ваше сообщение</label>
             <p>Чем детальнее опишите причину, тем лучше мы можем помочь.</p>
             <textarea name="mensaje" rows="5" cols="" required=""></textarea>
        </fieldset>
        <fieldset>
            <label>Ссылка (необязательно)</label>
            <input type="text" name="dtpermalink">
        </fieldset>
        <fieldset>
            <input type="submit" value="Отправить сообщение">
        </fieldset>
    </form>
</div>
@endsection
