<?php
/**
 * @var \App\Models\User $client
 * @var \Illuminate\Support\Collection $records
 */
?>

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
                        <h4 class="center">{{ $client->first_name }} {{ $client->last_name }}</h4>

                        <p class="flow-text">{{ $client->clientInformation->note }}</p>
                    </div>
                </div>
            </div>

            @if($records->count() > 0)
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
                    <?php  /** @var \App\Models\Record $item */ ?>
                    @foreach($records->all() as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->date_start->format('d.m.Y') }}</td>
                            <td>{{ $item->date_start->format('H:i') }}</td>
                            <td>{{ $item->date_finish->format('H:i') }}</td>
                            <td>
                                <a href="{{ route('master.record.edit', ['id' => $item->id]) }}">
                                    <i class="material-icons">edit</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </main>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large pink">
            <i class="large material-icons">dehaze</i>
        </a>
        <ul>
            <li>
                <a class="btn-floating pink" href="{{ route('master.user.edit', ['id' => $client->id]) }}">
                    <i class="material-icons">mode_edit</i>
                </a>
            </li>
            <li>
                <a class="btn-floating pink" href="{{ route('master.user.create_record', ['id' => $client->id]) }}">
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
