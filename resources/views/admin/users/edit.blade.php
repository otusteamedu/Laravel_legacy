@extends('layouts.admin')
@section('breadcrumbs', '')
@section('h1')
    Редактирование пользователя №{{$user->id}}
@stop

@section("content")
    <div class="row">
        <div class="col-12">
            @include('layouts.blocks.form.errors')
            {{ Form::model( $user, ['route' => ['admin.users.update', $user->id], 'method' => 'put', 'role' => 'form'] ) }}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            {{ Form::label('created_at', 'Создан', ['class' => 'control-label']) }}
                            <p class="control-label">{{$user->created_at}}</p>
                        </div>
                        <div class="form-group">
                            {{ Form::label('updated_at', 'Изменен', ['class' => 'control-label']) }}
                            <p class="control-label">{{$user->updated_at}}</p>
                        </div>
                        <div class="form-group form-check">
                            {{ Form::checkbox('active', $user->active, $user->active, ['class' => 'form-check-input']) }}
                            {{ Form::label('active', 'Активность', ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            {{ Form::label('name', 'Имя', ['class' => 'control-label']) }}
                            {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('last_name', 'Фамилия', ['class' => 'control-label']) }}
                            {{ Form::text('last_name', $user->last_name, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('picture_id', 'Изображение', ['class' => 'control-label']) }}
                            {{ Form::text('picture_id', $user->picture_id, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('country_id', 'Страна', ['class' => 'control-label']) }}
                            {{ Form::select(
                                'country_id',
                                ['1' => 'Россия', '2' => 'Украина'],
                                null,
                                ['class' => 'form-control'])
                            }} <!-- @ToDo: заменить на динамические значения  -->
                        </div>
                        <div class="form-group">
                            {{ Form::label('region', 'Регион', ['class' => 'control-label']) }}
                            {{ Form::text('region', $user->region, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('locality', 'Населенный пункт', ['class' => 'control-label']) }}
                            {{ Form::text('locality', $user->locality, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('remember_token', 'Токен восстановления пароля', ['class' => 'control-label']) }}
                            {{ Form::text('remember_token', $user->remember_token, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
                            {{ Form::email('email', $user->email, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone', 'Телефон', ['class' => 'control-label']) }}
                            {{ Form::text('phone', $user->phone, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Пароль', ['class' => 'control-label']) }}
                            {{ Form::text('password', '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('timezone', 'Часовой пояс', ['class' => 'control-label']) }}
                            {{ Form::text('timezone', '', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email_verified_at', 'Email подтвержден (дата)', ['class' => 'control-label']) }}
                            {{ Form::text('email_verified_at', $user->email_verified_at, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone_verified_at', 'Телефон подтвержден (дата)', ['class' => 'control-label']) }}
                            {{ Form::text('phone_verified_at', $user->phone_verified_at, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-outline-secondary float-left mr-2" value="save">
                                <svg height="12" class="octicon octicon-database" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M6 15c-3.31 0-6-.9-6-2v-2c0-.17.09-.34.21-.5.67.86 3 1.5 5.79 1.5s5.12-.64 5.79-1.5c.13.16.21.33.21.5v2c0 1.1-2.69 2-6 2zm0-4c-3.31 0-6-.9-6-2V7c0-.11.04-.21.09-.31.03-.06.07-.13.12-.19C.88 7.36 3.21 8 6 8s5.12-.64 5.79-1.5c.05.06.09.13.12.19.05.1.09.21.09.31v2c0 1.1-2.69 2-6 2zm0-4c-3.31 0-6-.9-6-2V3c0-1.1 2.69-2 6-2s6 .9 6 2v2c0 1.1-2.69 2-6 2zm0-5c-2.21 0-4 .45-4 1s1.79 1 4 1 4-.45 4-1-1.79-1-4-1z"></path></svg>
                                Сохранить
                            </button>
                            <p class="float-left mr-2">
                                <a class="btn btn-sm btn-outline-secondary" href="http://otus/admin/users/16">
                                    <svg height="12" class="octicon octicon-person" viewBox="0 0 12 16" version="1.1" width="24" aria-hidden="true"><path fill-rule="evenodd" d="M12 14.002a.998.998 0 01-.998.998H1.001A1 1 0 010 13.999V13c0-2.633 4-4 4-4s.229-.409 0-1c-.841-.62-.944-1.59-1-4 .173-2.413 1.867-3 3-3s2.827.586 3 3c-.056 2.41-.159 3.38-1 4-.229.59 0 1 0 1s4 1.367 4 4v1.002z"></path></svg>
                                    На детальную
                                </a>
                            </p>
                            <p>
                                <a href="{{route('admin.users.index')}}" class="btn btn-sm btn-outline-secondary">
                                    <svg class="bi bi-list-ol" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7 13.5a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5zm0-4a.5.5 0 01.5-.5h9a.5.5 0 010 1h-9a.5.5 0 01-.5-.5z" clip-rule="evenodd"></path>
                                        <path d="M3.713 13.865v-.474H4c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 01-.492.594v.033a.615.615 0 01.569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V11H3.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 00-.342.338v.041zM4.564 7h-.635V4.924h-.031l-.598.42v-.567l.629-.443h.635V7z"></path>
                                    </svg>
                                    Вернуться к списку
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
