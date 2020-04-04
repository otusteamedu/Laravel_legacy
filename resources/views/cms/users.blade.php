@extends('layouts.cms')

@section('title', 'Пользователи')

@section('content')
    <div class="container">
        <div class="tab-pane mb-2">
            <a class="btn btn-primary btn-lg" href="javascript:void(0);" role="button" @click="add = 1;">Добавить</a>
            <a class="btn btn-primary btn-lg" href="{{ route('cms.users.index') }}" role="button">Обновить</a>
            {{ Form::open(array('url' => route('cms.users.index'), 'class' => 'btn')) }}
            {{ Form::text('search', $search) }}
            {{ Form::submit('Найти') }}
            {{ Form::close() }}
        </div>
        <div v-if="add" class="mb-2">
            <div class="form-group">
                {{ Form::label('Имя пользователя') }}
                {{ Form::text('name', '',  ['ref' => 'name_0', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Email') }}
                {{ Form::text('email', '',  ['ref' => 'email_0', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Пароль') }}
                {{ Form::password('password', ['ref' => 'password_0', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('Права') }}
                {{ Form::select('level', $levels, '', ['ref' => 'level_0', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <a class="btn btn-success" href="javascript:void(0);" @click="save('{{ route('cms.users.store') }}', '0', ['name','email','password','level'])">Сохранить</a>
                <a class="btn btn-info" href="javascript:void(0);" @click="add = 0">Отмена</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped  table-bordered">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Имя пользователя</th>
                    <th scope="col">Email</th>
                    <th scope="col">Права</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach($users as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <template v-if="edit != '{{ $item->id }}'">
                                    {{ $item->name }}
                                </template>
                                <template v-else>
                                    {{ Form::text('name', $item->name, ['ref' => 'name_' .  $item->id]) }}
                                </template>
                            </td>
                            <td>
                                <template v-if="edit != '{{ $item->id }}'">
                                    {{ $item->email }}
                                </template>
                                <template v-else>
                                    {{ Form::text('email', $item->email, ['ref' => 'email_' .  $item->id]) }}
                                </template>
                            </td>
                            <td>
                                <template v-if="edit != '{{ $item->id }}'">
                                    {{ $levels[$item->level] ?? '' }}
                                </template>
                                <template v-else>
                                    {{ Form::select('level', $levels, $item->level ?? '', ['ref' => 'level_' .  $item->id]) }}
                                </template>
                            </td>
                            <td>
                                <template v-if="edit != '{{ $item->id }}'">
                                    <a href="javascript:void(0);" @click="edit = '{{ $item->id }}'" class="btn btn-info">Изменить</a>
                                    <a href="javascript:void(0);" @click.stop.prevent="remove('{{ route('cms.users.delete') }}', '{{ $item->id }}')" class="btn btn-danger">Удалить</a>
                                </template>
                                <template v-else>
                                    <a href="javascript:void(0);" @click="save('{{ route('cms.users.update') }}', '{{ $item->id }}', ['name','email','level'])" class="btn btn-success" >Сохранить</a>
                                    <a href="javascript:void(0);" @click="edit = 0" class="btn btn-info" >Отмена</a>
                                </template>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        </div>

    </div>
@endsection
