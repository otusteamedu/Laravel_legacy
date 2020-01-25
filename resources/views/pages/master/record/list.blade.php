@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <h4>Список записей</h4>

            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Время</th>
                    <th></th>
                </tr>
                </thead>
            </table>

            <div class="card-panel pink lighten-3 sticky no-margin record-list">23.04.2019</div>
            <table>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Мария</td>
                        <td>Слепакова</td>
                        <td>18:10</td>
                        <td>
                            <a href="{{ route('master.record.edit', ['id' => 1]) }}"><i class="material-icons">edit</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Александра</td>
                        <td>Григорьева</td>
                        <td>18:10</td>
                        <td>
                            <a href="{{ route('master.record.edit', ['id' => 2]) }}"><i class="material-icons">edit</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ольга</td>
                        <td>Кондратьева</td>
                        <td>18:10</td>
                        <td>
                            <a href="{{ route('master.record.edit', ['id' => 3]) }}"><i class="material-icons">edit</i></a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="card-panel pink lighten-3 sticky no-margin record-list">22.04.2019</div>
            <table>
                <tbody>
                <tr>
                    <td>4</td>
                    <td>Мария</td>
                    <td>Слепакова</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 1]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Александра</td>
                    <td>Григорьева</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 2]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Ольга</td>
                    <td>Кондратьева</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 3]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="card-panel pink lighten-3 sticky no-margin record-list">21.04.2019</div>
            <table>
                <tbody>
                <tr>
                    <td>7</td>
                    <td>Мария</td>
                    <td>Слепакова</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 1]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Александра</td>
                    <td>Григорьева</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 2]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Ольга</td>
                    <td>Кондратьева</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 3]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="card-panel pink lighten-3 sticky no-margin record-list">20.04.2019</div>
            <table>
                <tbody>
                <tr>
                    <td>10</td>
                    <td>Мария</td>
                    <td>Слепакова</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 1]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Александра</td>
                    <td>Григорьева</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 2]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Ольга</td>
                    <td>Кондратьева</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 3]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="card-panel pink lighten-3 sticky no-margin record-list">19.04.2019</div>
            <table>
                <tbody>
                <tr>
                    <td>13</td>
                    <td>Мария</td>
                    <td>Слепакова</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 1]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Александра</td>
                    <td>Григорьева</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 2]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>Ольга</td>
                    <td>Кондратьева</td>
                    <td>18:10</td>
                    <td>
                        <a href="{{ route('master.record.edit', ['id' => 3]) }}"><i class="material-icons">edit</i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </main>
@endsection

@push('styles')
    <link href="{{ mix('/css/pages/master/records/list.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ mix('/js/pages/master/records/list.js') }}"></script>
@endpush
