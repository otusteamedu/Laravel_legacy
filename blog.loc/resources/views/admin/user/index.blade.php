@extends('admin.layouts.app')

@section('top_nav')
    @include('admin.navigation.top_menu')
@endsection

@section('main')
    <div class="row p-1">
        <div class="col-8">
            <h3>{{ $pageTitle }}</h3>
        </div>
        <div class="col-4">
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalUserAdd">Создать пользователя</button>
        </div>
    </div>

    @include('admin._particle.flash.errors')

    @include('admin._particle.flash.success')

    @include('admin._particle.flash.error')

    {{-- TODO: фильтр--}}
    <div class="table-responsive">
        @if(isset($users))
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">День рождения</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Роль</th>
                    <th scope="col">Дата создания</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>
                            @if($user->status === 'unactive')
                                <span class="badge badge-danger">
                                    <a data-id="{{ $user->id }}" class="unactive">
                                        {{ $user->status }}
                                    </a>
                                </span>
                            @else
                                <span class="badge badge-success">
                                    <a data-id="{{ $user->id }}" class="active">
                                        {{ $user->status }}
                                    </a>
                                </span>
                            @endif
                        </td>
                        <td>{{ $user->role->role }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', ['id' => $user->id]) }}" class="btn btn-outline-dark">Инфо</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            Нет данных
        @endif
    </div>

    @if(isset($users))
        {{-- Добавление пользователя --}}
        @include('admin._particle.modal.modal_add_user')

        {{-- Активация пользователя --}}
        @include('admin._particle.modal.modal_activate_user')

        {{-- Деактивация пользователя --}}
        @include('admin._particle.modal.modal_deactivate_user')
    @endif
@endsection