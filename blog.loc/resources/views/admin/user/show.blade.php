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
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

    </div>

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

    {{-- Редактирование имени --}}
    <div class="modal fade" id="modalFirstNameEdit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userFirstNameModalLabel">Редактирование имени пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.users.editFirstName', ['id' => $user->id]) }}">
                        @csrf
                        <input name="id" type="hidden" value="{{ $user->id }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="first_name">Имя</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $user->first_name }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary send_modal_form">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Редактирование фамилии --}}
    <div class="modal fade" id="modalLastNameEdit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userLastNameModalLabel">Редактирование фамилии пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.users.editLastName', ['id' => $user->id]) }}">
                        @csrf
                        <input name="id" type="hidden" value="{{ $user->id }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="first_name">Фамилия</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $user->last_name }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary send_modal_form">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Редактирование дня рождения --}}
    <div class="modal fade" id="modalBirthdayEdit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userLastNameModalLabel">Редактирование дня рождения</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.users.editBirthday', ['id' => $user->id]) }}">
                        @csrf
                        <input name="id" type="hidden" value="{{ $user->id }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="first_name">День рождения</label>
                            <input type="text" name="birthday" class="form-control" id="datepicker" value="{{ $user->birthday }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary send_modal_form">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Редактирование роли --}}
    <div class="modal fade" id="modalRoleEdit" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userRoleModalLabel">Редактирование роли</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.users.editRole', ['id' => $user->id]) }}">
                        @csrf
                        <input name="id" type="hidden" value="{{ $user->id }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="role">Роль</label>
                            <select class="form-control" name="role" id="role">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($role->id === $user->role_id) selected @endif>
                                        {{ $role->role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary send_modal_form">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Удаление пользователя --}}
    <div class="modal fade" id="modalUserDelete" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDeleteModalLabel">Удаление пользователя</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.users.destroy', ['id' => $user->id]) }}">
                        @csrf
                        <input name="id" type="hidden" value="{{ $user->id }}">
                        <input type="hidden" name="_method" value="DELETE">
                        Вы действительно хотите удалить пользователя {{ $user->email }}?
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
                    <button type="button" class="btn btn-primary send_modal_form">Да</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Изменение пароля --}}
    <div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userDeleteModalLabel">Изменение пароля</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.users.changePassword', ['id' => $user->id]) }}">
                        @csrf
                        <input name="id" type="hidden" value="{{ $user->id }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Повторите пароль</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Повторите пароль">
                        </div>
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