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

    <div class="col-4 flash">
        @foreach ($errors->all() as $message)
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Ошибка!</strong> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    </div>
    <div class="col-4 flash">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show " role="alert">
                <strong>Успех!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

    </div>

    {{-- TODO: фильтр--}}
    <div class="table-responsive">
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
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Добавление пользователя --}}
    <div class="modal fade" id="modalUserAdd" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userAddModalLabel">Добавление пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введите email">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Повторите пароль</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Повторите пароль">
                        </div>
                        <div class="form-group">
                            <label for="role">Выберите роль</label>
                            <select name="role" class="form-control" id="role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary send_modal_form">Добавить</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Активация пользователя --}}
    <div class="modal fade" id="modalUserActivate" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userActivateModalLabel">Активация пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.users.active') }}">
                        @csrf
                        <input name="id" type="hidden" value="">
                        <input type="hidden" name="_method" value="PATCH">
                        Вы действительно хотите активировать пользователя?
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                    <button type="button" class="btn btn-primary send_modal_form">Да</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Деактивация пользователя --}}
    <div class="modal fade" id="modalUserUnactivate" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userUnactivateModalLabel">Деактивация пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.users.unactive') }}">
                        @csrf
                        <input name="id" type="hidden" value="">
                        <input type="hidden" name="_method" value="PATCH">
                        Вы действительно хотите деактивировать пользователя?
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                    <button type="button" class="btn btn-primary send_modal_form">Да</button>
                </div>
            </div>
        </div>
    </div>
@endsection