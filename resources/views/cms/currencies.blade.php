@extends('layouts.cms')

@section('title', 'Валюты')

@section('content')
    <div class="container">
        <div class="tab-pane mb-2">
            <a class="btn btn-primary btn-lg" href="javascript:void(0);" role="button" @click="add = 1;">Добавить</a>
            <a class="btn btn-primary btn-lg" href="{{ route('cms.currencies.index') }}" role="button">Обновить</a>
            {{ Form::open(array('url' => route('cms.currencies.index'), 'class' => 'btn')) }}
            {{ Form::text('code', $code) }}
            {{ Form::submit('Найти') }}
            {{ Form::close() }}
        </div>
        <div v-if="add" class="mb-2">
            {{ Form::label('Код валюты') }}
            {{ Form::text('code', '',  ['ref' => 'code_0']) }}
            <a class="btn btn-success" href="javascript:void(0);" @click="save('{{ route('cms.currencies.store') }}', '0', ['code'])">Сохранить</a>
            <a class="btn btn-info" href="javascript:void(0);" @click="add = 0">Отмена</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped  table-bordered">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Код валюты</th>
                    <th scope="col">Действие</th>
                </tr>
                </thead>
                <tbody>
                <tbody>
                    @foreach($currencies as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <template v-if="edit != '{{ $item->id }}'">
                                    {{ $item->code }}
                                </template>
                                <template v-else>
                                    {{ Form::text('code', $item->code, ['ref' => 'code_' .  $item->id]) }}
                                </template>
                            </td>
                            <td>
                                <template v-if="edit != '{{ $item->id }}'">
                                    <a href="javascript:void(0);" @click="edit = '{{ $item->id }}'" class="btn btn-info">Изменить</a>
                                    <a href="javascript:void(0);" @click.stop.prevent="remove('{{ route('cms.currencies.delete') }}', '{{ $item->id }}')" class="btn btn-danger">Удалить</a>
                                </template>
                                <template v-else>
                                    <a href="javascript:void(0);" @click="save('{{ route('cms.currencies.update') }}', '{{ $item->id }}', ['code'])" class="btn btn-success" >Сохранить</a>
                                    <a href="javascript:void(0);" @click="edit = 0" class="btn btn-info" >Отмена</a>
                                </template>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $currencies->links() }}
        </div>

    </div>
@endsection
