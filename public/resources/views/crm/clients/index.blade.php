@extends('crm.layouts.nav_admin')
@section('content')
    <div>
        <div class="mt-3 mb-3">
            <h3>Автоcалоны</h3>
            {{ link_to(route('crm.clients.create'), 'добавить', ['class' => 'btn btn-outline-success']) }}
        </div>
        <div>
            <table class="table" style="max-width: 990px;">
                <tr>
                    <th>id</th>
                    <th>Название</th>
                    <th>Регион</th>
                    <th style="max-width: 150px;">&nbsp;</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item['region']['name'] }}</td>
                        <td style="max-width: 150px;">
                            <div class="btn-group" role="group">
                                {{ link_to(route('crm.clients.edit', ['client' => $item]), 'изменить',
                                    ['class' => 'btn btn-sm btn-outline-primary']) }}
                                    @include('crm.clients.blocks.form_delete')
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{ $items->links() }}
@endsection
