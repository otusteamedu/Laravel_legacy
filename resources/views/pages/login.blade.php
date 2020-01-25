@extends('layout-empty')

@section('body')
    <main>
            <div class="col s12 z-depth-4 card-panel">
                <form class="login-form" method="post">
                    <div class="row">
                        <div class="input-field col s12 no-margin">
                            <i class="material-icons prefix">email</i>

                            <input id="email" type='email'>
                            <label for="email">Введите ваш email</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class='input-field col s12 no-margin'>
                            <i class="material-icons prefix">security</i>

                            <input id="password" type="password">
                            <label for="password">Введите пароль</label>
                        </div>
                    </div>

                    <label>
                        <input type="checkbox" />
                        <span>Запомнить</span>
                    </label>

                    <div class="row no-margin-bottom">
                        <div class="input-field col s12">
                            <button type='submit' name='btn_login' class='btn waves-effect waves-light pink col s12'>
                                Войти
                            </button>
                        </div>
                    </div>
                </form>
            </div>
    </main>
@endsection

@push('styles')
    <link href="{{ mix('/css/pages/login.css') }}" rel="stylesheet">
@endpush
