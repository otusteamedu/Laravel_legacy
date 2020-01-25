@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <div class="row">
                <div class="valign-wrapper user-information">
                    <div class="col s12 l6">
                        <div class="user-picture">
                            <img src="https://via.placeholder.com/450" alt="" class="responsive-img circle"/>
                        </div>
                    </div>

                    <div class="col s12 l6">
                        <h4 class="center">Мария Слепакова</h4>

                        <p class="flow-text">Ненавидит синий цвет и блестки. Любит котиков и лошадей.</p>
                    </div>
                </div>
            </div>

            <h5>Список записей:</h5>

            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Дата</th>
                    <th colspan="2">Время (c - по)</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>1</td>
                    <td>22.12.2019</td>
                    <td>14:00</td>
                    <td>16:00</td>
                    <td><a href="{{ route('master.record.edit', ['id' => 1]) }}"><i class="material-icons">edit</i></a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>1.12.2019</td>
                    <td>11:00</td>
                    <td>13:00</td>
                    <td><a href="{{ route('master.record.edit', ['id' => 2]) }}"><i class="material-icons">edit</i></a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>4.11.2019</td>
                    <td>09:00</td>
                    <td>11:00</td>
                    <td><a href="{{ route('master.record.edit', ['id' => 3]) }}"><i class="material-icons">edit</i></a></td>
                </tr>
                </tbody>
            </table>
        </div>

    </main>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large pink">
            <i class="large material-icons">dehaze</i>
        </a>
        <ul>
            <li>
                <a class="btn-floating pink" href="{{ route('master.user.edit', ['id' => 1]) }}">
                    <i class="material-icons">mode_edit</i>
                </a>
            </li>
            <li>
                <a class="btn-floating pink" href="{{ route('master.user.create_record', ['id' => 1]) }}">
                    <i class="material-icons">add</i>
                </a>
            </li>
        </ul>
    </div>
@endsection

@push('styles')
    <link href="{{ mix('/css/pages/master/users/detail.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ mix('/js/pages/master/users/detail.js') }}"></script>
@endpush
