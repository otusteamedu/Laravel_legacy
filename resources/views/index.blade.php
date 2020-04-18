@extends('layouts.base')

@section('title', __('menu.main'))

@section('content')
    <div class="container">

        <div class="tab-pane mb-2">
            <a class="btn btn-primary btn-lg" href="javascript:void(0);" role="button" @click="add = 1;">@lang('main.add')</a>
            <a class="btn btn-primary btn-lg" href="{{ route('dashboard.index', $locale) }}" role="button">@lang('main.refresh')</a>
            {{ Form::open(array('url' => route('dashboard.index', $locale), 'class' => 'btn')) }}
            {{ Form::text('search', $search) }}
            {{ Form::submit(__('main.search')) }}
            {{ Form::close() }}
        </div>
        <div v-if="add" class="mb-2">
            <div class="form-group">
                {{ Form::label(__('main.field_name')) }}
                {{ Form::text('name', '',  ['ref' => 'name_0', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label(__('main.field_price')) }}
                {{ Form::text('summ', '',  ['ref' => 'summ_0', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <a class="btn btn-success" href="javascript:void(0);" @click="save('{{ route('dashboard.store', $locale) }}', '0', ['name','summ'])">@lang('main.save')</a>
                <a class="btn btn-info" href="javascript:void(0);" @click="add = 0">@lang('main.cancel')</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped  table-bordered">
                <thead>
                <tr>
                    {{--<th scope="col">Id</th>--}}
                    <th scope="col">@lang('main.field_name')</th>
                    <th scope="col">@lang('main.field_price')</th>
                    {{--<th scope="col">Действие</th>--}}
                </tr>
                </thead>
                <tbody>
                <tbody>
                @foreach($incomes as $item)
                    <tr>
                        {{--<td>{{ $item->id }}</td>--}}
                        <td>
                            <template v-if="edit != '{{ $item->id }}'">
                                {{ $item->name }}
                            </template>
                            <template v-else>
                                {{ Form::text('code', $item->name, ['ref' => 'name_' .  $item->id]) }}
                            </template>
                        </td>
                        <td>
                            <template v-if="edit != '{{ $item->id }}'">
                                {{ $item->summ }}
                            </template>
                            <template v-else>
                                {{ Form::text('summ', $item->name, ['ref' => 'summ_' .  $item->id]) }}
                            </template>
                        </td>
                        {{--
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
                        --}}
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $incomes->links() }}
        </div>

        <div class="row">
            @lang('main.summ'): {{ $summ }}
        </div>
    </div>
@endsection
