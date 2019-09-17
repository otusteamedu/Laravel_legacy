@extends('public.account.layout')

@section('pageTitle')
    @lang('public.account.register')
@endsection

@section('pageHeader')
    @lang('public.account.register')
@endsection

@section('pageContentMain')
    <form method="POST" action="{{ route('public.account.register') }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="staticName" class="col-sm-5 col-form-label">Ваше имя <span class="i-req">*</span></label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="staticName" value="" name="name">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticLastName" class="col-sm-5 col-form-label">Ваша фамилия</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="staticLastName" value="" name="lastname">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticLastName" class="col-sm-5 col-form-label">
                Контактный телефон
            </label>
            <div class="col-sm-7">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+7</span>
                    </div>
                    <input type="text" class="form-control" id="staticLastName" value="" placeholder="(999) 999-99-99" name="lastname">
                </div>
                <small>Используется для входа</small>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-5 col-form-label">Пароль</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="inputPassword" name="password">
                <small>Используется для входа</small>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword2" class="col-sm-5 col-form-label">Повторите пароль</label>
            <div class="col-sm-7">
                <input type="password" class="form-control" id="inputPassword2" name="password2">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-5 col-form-label">Email</label>
            <div class="col-sm-7 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="staticEmail" value="" name="email">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticBDay" class="col-sm-5 col-form-label">Дата рождения</label>
            <div class="col-sm-7 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control" id="staticBDay" value="" name="birthday">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5"></div>
            <div class="col-sm-7">
                <input class="btn btn-primary" type="submit" value="Отправить">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-5"></div>
            <div class="col-sm-7">
                <span class="i-req">*</span> &mdash; обязательно для заполнения
            </div>
        </div>
    </form>
@endsection
