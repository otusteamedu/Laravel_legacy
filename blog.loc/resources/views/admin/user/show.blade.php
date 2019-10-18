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
            <button class="btn btn-danger float-right" data-toggle="modal" data-target="#modalUserDelete">Удалить пользователя</button>
        </div>
    </div>

    @include('admin._particle.flash.errors')

    @include('admin._particle.flash.success')

    @include('admin._particle.flash.error')

    {{-- TODO: фильтр--}}
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Имя</td>
                    <td>{{ $user->first_name }} <a href="#" class="float-right small" data-toggle="modal" data-target="#modalFirstNameEdit">Изменить</a></td>
                </tr>
                <tr>
                    <td>Фамилия</td>
                    <td>{{ $user->last_name }} <a href="#" class="float-right small" data-toggle="modal" data-target="#modalLastNameEdit">Изменить</a></td>
                </tr>
                <tr>
                    <td>День рождения</td>
                    <td>{{ $user->birthday }} <a href="#" class="float-right small" data-toggle="modal" data-target="#modalBirthdayEdit">Изменить</a></td>
                </tr>
                <tr>
                    <td>Активирован</td>
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
                </tr>
                <tr>
                    <td>Роль</td>
                    <td>{{ $user->role->role }} <a href="#" class="float-right small" data-toggle="modal" data-target="#modalRoleEdit">Изменить</a></td>
                </tr>
                <tr>
                    <td>Дата создания</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-outline-dark float-right" data-toggle="modal" data-target="#modalChangePassword">Изменить пароль</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Активация пользователя --}}
    @include('admin._particle.modal.modal_activate_user')

    {{-- Деактивация пользователя --}}
    @include('admin._particle.modal.modal_deactivate_user')

    {{-- Редактирование имени --}}
    @include('admin._particle.modal.modal_edit_first_name')

    {{-- Редактирование фамилии --}}
    @include('admin._particle.modal.modal_edit_last_name')

    {{-- Редактирование дня рождения --}}
    @include('admin._particle.modal.modal_edit_birthday')

    {{-- Редактирование роли --}}
    @include('admin._particle.modal.modal_edit_role')

    {{-- Удаление пользователя --}}
    @include('admin._particle.modal.modal_user_delete')

    {{-- Изменение пароля --}}
    @include('admin._particle.modal.modal_change_password')

@endsection