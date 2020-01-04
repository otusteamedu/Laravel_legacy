@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <h4>Редактирование клиента</h4>

            <div class="row">
                <form method="post">
                    <div class="input-field col s12 l6">
                        <input value="Слепакова" placeholder="Иванова" id="last_name" type="text" class="validate">
                        <label for="last_name">Фамилия</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input value="Мария" placeholder="Светлана" id="first_name" type="text" class="validate">
                        <label for="first_name">Имя</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <input value="Юриевна" placeholder="Сергеевна" id="first_name" type="text" class="validate">
                        <label for="first_name">Отчество</label>
                    </div>

                    <div class="input-field col s12 l6">
                        <textarea id="description" class="materialize-textarea">Ненавидит синий цвет и блестки. Любит котиков и лошадей.</textarea>
                        <label for="description">Примечание</label>
                    </div>

                    <div class="input-field col s12">
                        <button type="submit" class="waves-effect waves-light btn pink">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
