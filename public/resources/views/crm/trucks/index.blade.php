@extends('crm.layouts.nav_admin')
@section('content')
    <div>
        <div class="mt-3 mb-3">
            <h3>Автовозы</h3>
            {{ link_to(route('crm.trucks.create'), 'добавить', ['class' => 'btn btn-outline-primary']) }}
        </div>
        <div>
            <table class="table" style="max-width: 900px;">
                <tr>
                    <th>id</th>
                    <th>Марка</th>
                    <th>Номер</th>
                    <th>Вместимость</th>
                    <th style="max-width: 150px;">&nbsp;</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->brand }}</td>
                        <td>{{ $item->plate }}</td>
                        <td>{{ $item->cars }}</td>
                        <td style="max-width: 150px;">
                            <div class="row">
                                <div class="col">
                                    @if($edit)
                                    {{ link_to(route('crm.trucks.edit', ['truck' => $item]), 'изменить',
                                    ['class' => 'btn btn-outline-primary']) }}
                                        @endif
                                </div>
                                <div class="col">
                                    @include('crm.trucks.blocks.form_delete')
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
