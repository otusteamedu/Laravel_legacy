@extends($layout)
@section('content')
    <div>
        <div class="mt-3 mb-3">
            <h3>Автоcалоны</h3>
            {{ link_to(route('crm.clients.create'), 'добавить', ['class' => 'btn btn-outline-primary']) }}
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
                            <div class="row">
                                <div class="col">
                                    {{ link_to(route('crm.clients.edit', ['client' => $item]), 'изменить',
                                    ['class' => 'btn btn-outline-primary']) }}
                                </div>
                                <div class="col">
                                    @include('crm.clients.blocks.form_delete')
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
