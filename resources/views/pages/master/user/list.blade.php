<?php
/** @var LengthAwarePaginator|null $clients */

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

$masterClientItems = $clients === null ? [] : $clients->items();
$lastPage = $clients->lastPage();
?>

@extends('layout')

@section('body')
    <main>
        @component('components.header')@endcomponent

        <div class="container">
            <h4>Список клиентов</h4>
            @if($masterClientItems === null)
                <p>Клиенты не найдены</p>
            @else
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
                    <?php /** @var User $masterClientItem */?>
                    @foreach($masterClientItems as $masterClientItem)
                        <tr>
                            <td>{{ $masterClientItem->id }}</td>
                            <td>{{ $masterClientItem->first_name }}</td>
                            <td>{{ $masterClientItem->last_name }}</td>
                            <td>
                                <a href="{{ route('master.user.detail', ['id' => $masterClientItem->id]) }}">
                                    <i class="material-icons">edit</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <ul class="pagination center">
                    @if($clients->previousPageUrl() !== null)
                        <li class="disabled">
                            <a href="{{ $clients->previousPageUrl() }}">
                                <i class="material-icons">chevron_left</i>
                            </a>
                        </li>
                    @endif
                    @for($pageNumber = 1; $pageNumber <= $lastPage; $pageNumber++)
                        @if ($pageNumber === $clients->currentPage())
                            <li class="active">
                                <a href="{{ route('master.user.list', ['page' => $pageNumber]) }}">
                                    {{ $pageNumber }}
                                </a>
                            </li>
                        @else
                            <li class="waves-effect">
                                <a href="{{ route('master.user.list', ['page' => $pageNumber]) }}">
                                    {{ $pageNumber }}
                                </a>
                            </li>
                        @endif
                    @endfor
                    @if($clients->nextPageUrl() !== null)
                        <li class="disabled">
                            <a href="{{ $clients->nextPageUrl() }}">
                                <i class="material-icons">chevron_right</i>
                            </a>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    </main>

    <div class="fixed-action-btn">
        <a href="{{ route('master.user.create') }}" class="btn-floating btn-large pink">
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
