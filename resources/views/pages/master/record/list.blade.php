<?php
/** @var \Illuminate\Support\Collection $masterRecords */

//dd($masterRecords);
?>

@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            @if($masterRecords->count() > 0)
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

            <?php /** @var \Illuminate\Support\Collection $day */ ?>
            @foreach($masterRecords->all() as $day)
                @php
                /** @var \App\Models\Record $firstDay */
                $firstDay = $day->all()[0];
                $firstDayDate = $firstDay->date_start->format('d.m.Y');
                @endphp
            <div class="pink lighten-3 sticky no-margin record-list">
                {{ $firstDayDate }}
            </div>
            <table>
                <tbody>
                <?php /** @var \App\Models\Record $item */ ?>
                    @foreach($day->all() as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->client->first_name }}</td>
                        <td>{{ $item->client->last_name }}</td>
                        <td>{{ $item->date_start->format('H:i') }}</td>
                        <td>
                            <a href="{{ route('master.record.edit', ['id' => $item->id]) }}">
                                <i class="material-icons">edit</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
            @endif
        </div>

    </main>
@endsection

@push('styles')
    <link href="{{ mix('/css/pages/master/records/list.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ mix('/js/pages/master/records/list.js') }}"></script>
@endpush
