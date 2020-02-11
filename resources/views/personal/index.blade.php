@extends('layouts.app')
@section('breadcrumbs', '')

@section("content")
    <div class="row my-2">
        <div class="col-lg-4 mb-4 text-center">
            <img src="https://ya-webdesign.com/images/avatar-png-1.png"
                 class="mx-auto img-fluid img-circle d-block" alt="avatar" width="200px" height="200px">
            <h6 class="mt-2">Выбрать другое фото</h6>
            <label class="custom-file">
                <input type="file" id="file" class="custom-file-input">
                <span class="custom-file-control btn btn-primary">Выбрать файл</span>
            </label>
        </div>
        <div class="col-lg-8 mb-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Профиль</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Редактировать</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">Профиль</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Пользователь</strong><br>
                                Иван Иванов
                            </p>
                            <p>
                                <strong>Контакты</strong><br>
                                email@test.ru <br>
                                +7 908 999 99 99
                            </p>
                            <p>
                                <strong>Адрес</strong><br>
                                Россия, Казань.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6>Результаты:</h6>
                            <p>
                                Нашел кладов: <a href="/" class="badge badge-dark badge-pill">23</a>
                            </p>
                            <p>
                                Создал кладов: <a href="/" class="badge badge-dark badge-pill">14</a>
                            </p>
                            <p>
                                Оставил комментариев: <a href="/" class="badge badge-dark badge-pill">124</a>
                            </p>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Последняя
                                активность:
                            </h5>
                            <table class="table table-sm table-hover table-striped">
                                <tbody>
                                <tr>
                                    <td>
                                        Создал клад <strong>"Тайна заброшенного элеватора"</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Нашел клад <strong>Сюрприз меловой пещеры</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Прокомментировал <strong>История старого дуба</strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="edit">
                    <form role="form">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Имя</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="Иван">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Фамилия</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" value="Иванов">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" value="email@gmail.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Номер телефона</label>
                            <div class="col-lg-9">
                                <input id="form_phone" type="tel" name="phone" class="form-control"
                                       placeholder="+7 906 999 99 99">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Страна</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="country" value="Россия">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Город</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="city" value="Казань">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Часовой пояс</label>
                            <div class="col-lg-9">
                                <select id="user_time_zone" class="form-control" size="0">
                                    <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                    <option value="Alaska">(GMT-09:00) Alaska</option>
                                    <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp;
                                        Canada)
                                    </option>
                                    <option value="Arizona">(GMT-07:00) Arizona</option>
                                    <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp;
                                        Canada)
                                    </option>
                                    <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00)
                                        Central Time (US &amp; Canada)
                                    </option>
                                    <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp;
                                        Canada)
                                    </option>
                                    <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Пароль</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" value="11111122333">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Повторите пароль</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password" value="11111122333">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Отменить">
                                <input type="button" class="btn btn-primary" value="Сохранить изменения">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
