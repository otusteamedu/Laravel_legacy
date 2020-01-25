@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <h4>Список клиентов</h4>

            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>1</td>
                    <td>Мария</td>
                    <td>Слепакова</td>
                    <td><a href="{{ route('master.user.detail', ['id' => 1]) }}"><i class="material-icons">edit</i></a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Александра</td>
                    <td>Григорьева</td>
                    <td><a href="{{ route('master.user.detail', ['id' => 2]) }}"><i class="material-icons">edit</i></a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Ольга</td>
                    <td>Кондратьева</td>
                    <td><a href="{{ route('master.user.detail', ['id' => 3]) }}"><i class="material-icons">edit</i></a></td>
                </tr>
                </tbody>
            </table>

            <ul class="pagination center">
                <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                <li class="active"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
            </ul>
        </div>
    </main>

    <div class="fixed-action-btn">
        <a href="{{ route('master.user.edit', ['id' => 1]) }}" class="btn-floating btn-large pink">
            <i class="large material-icons">add</i>
        </a>
    </div>
@endsection

@push('styles')
    <link href="{{ mix('/css/pages/master/users/list.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ mix('/js/pages/master/users/list.js') }}"></script>
@endpush
