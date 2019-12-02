@extends('crm.layouts.nav_admin')

@section('content')
    <div>
        <div class="mt-3 mb-3">
            <h3>Заказы</h3>
            @if($add)
            {{ link_to(route('crm.orders.create'), 'добавить', ['class' => 'btn btn-outline-primary']) }}
                @endif
        </div>
        <div>
            <table class="table" style="max-width: 990px;">
                <tr>
                    <th>id</th>
                    <th>Дата</th>
                    <th>Количество</th>
                    <th style="max-width: 150px;">&nbsp;</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->amount }}</td>
                        <td style="max-width: 150px;">
                            <div class="row">
                                <div class="col">
                                    {{ link_to(route('crm.orders.edit', ['client' => $item]), 'изменить',
                                    ['class' => 'btn btn-outline-primary']) }}
                                </div>
                                <div class="col">
                                    @include('crm.orders.blocks.form_delete')
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
