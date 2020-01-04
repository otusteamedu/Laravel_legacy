@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <h4>Создание клиента</h4>

            <div class="row">
                <form method="post">
                    <div class="input-field col s12 l6">
                        <input value="" placeholder="Иванова" id="last_name" type="text" class="validate">
                        <label for="last_name">Фамилия</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input value="" placeholder="Светлана" id="first_name" type="text" class="validate">
                        <label for="first_name">Имя</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input value="" placeholder="Сергеевна" id="first_name" type="text" class="validate">
                        <label for="first_name">Отчество</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <textarea id="description" class="materialize-textarea"></textarea>
                        <label for="description">Примечание</label>
                    </div>

                    <div class="input-field col s12">
                        <button type="submit" class="waves-effect waves-light btn red lighten-2">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
