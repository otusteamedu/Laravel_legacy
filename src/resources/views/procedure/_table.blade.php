<?php
/**
 * @var \App\Models\Procedure $procedure
 * @var $procedures
 */
?>
<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('procedure.table.name') }}</th>
        <th scope="col">{{ __('procedure.table.duration') }}</th>
        <th scope="col">{{ __('procedure.table.price') }}</th>
        <th scope="col">{{ __('procedure.table.people_count') }}</th>
        <th scope="col"><i class="fa fa-bolt"></i></th>
    </tr>
    </thead>
    <tbody>
    @forelse($procedures as $procedure)
        <tr>
            <th scope="row">{{ $procedure->id }}</th>
            <td>{{ $procedure->name }}</td>
            <td>{{ $procedure->duration }}</td>
            <td>{{ $procedure->price }}</td>
            <td>{{ $procedure->people_count }}</td>
            <td>
                <a href="{{ route('procedure.show', ['procedure' => $procedure->id]) }}"
                   class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>

                <a href="{{ route('procedure.edit', ['procedure' => $procedure->id]) }}"
                   class="btn btn-sm btn-outline-info"><i class="fa fa-pen-alt"></i></a>

                <form action="{{ route('procedure.destroy', $procedure->id) }}" method="POST" class="d-inline">
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
            <td colspan="333" class="text-center text-muted">
                {{ __('procedure.empty') }}<br/>

                <a href="{{ route('procedure.create') }}" class="btn btn-sm btn-outline-success">
                    <i class="fa fa-plus"></i> {{ __('buttons.procedure.add') }}
                </a>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
