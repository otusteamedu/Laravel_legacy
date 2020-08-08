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
        <th scope="col">{{ __('record.table.procedure_id') }}</th>
        <th scope="col">{{ __('record.table.client_id') }}</th>
        <th scope="col">{{ __('record.table.time') }}</th>
        <th scope="col"><i class="fa fa-bolt"></i></th>
    </tr>
    </thead>
    <tbody>
    @forelse($records as $record)
        <tr>
            <th scope="row">{{ $record->procedure_id }}</th>
            <td>{{ $record->client_id }}</td>
            <td>{{ $record->time }}</td>
            <td>
                <a href="{{ route('record.show', ['record' => $record->id]) }}"
                   class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>

                <a href="{{ route('record.edit', ['record' => $record->id]) }}"
                   class="btn btn-sm btn-outline-info"><i class="fa fa-pen-alt"></i></a>

                <form action="{{ route('record.destroy', $record->id) }}" method="POST" class="d-inline">
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
                {{ __('record.empty') }}<br/>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
