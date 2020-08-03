<?php
/**
 * @var \App\Models\Procedure $procedure
 */
?>

<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Процедура</th>
        <th scope="col">Салон</th>
        <th scope="col">Работник</th>
        <th scope="col">Продолжительность</th>
        <th scope="col">Цена</th>
        <th scope="col">Кол-во чел.</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($procedures as $procedure)
        <tr>
            <th scope="row">{{ $procedure->id }}</th>
            <td>{{ $procedure->name }}</td>
            <td>{{ $procedure->business_id }}</td>
            <td>{{ $procedure->worker->name }}</td>
            <td>{{ $procedure->duration }}</td>
            <td>{{ $procedure->price }}</td>
            <td>{{ $procedure->people_count }}</td>
            <td>
                <a href="{{ route('admin.procedure.show', ['procedure' => $procedure->id]) }}"
                   class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>

                <a href="{{ route('admin.procedure.edit', ['procedure' => $procedure->id]) }}"
                   class="btn btn-sm btn-outline-info"><i class="fa fa-pen-alt"></i></a>

                <form action="{{ route('admin.procedure.destroy', $procedure->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="333" class="text-center text-muted">Empty! ...</td>
        </tr>
    @endforelse
    </tbody>
</table>
