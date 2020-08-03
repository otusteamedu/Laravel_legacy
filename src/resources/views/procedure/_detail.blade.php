<a href="{{ route('procedure.edit', ['procedure' => $procedure->id]) }}"
   class="btn btn-outline-info"><i class="fa fa-pen-alt"></i> Edit</a>

<form action="{{ route('procedure.destroy', $procedure->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-outline-danger" title="Delete">
        <i class="fa fa-trash-alt"></i> Delete
    </button>
</form>

<table class="table table-hover mt-4">
    <tbody>
    <tr>
        <th scope="row">{{ __('procedure.table.name') }}</th>
        <td>{{ $procedure->name }}</td>
    </tr>
    <tr>
        <th scope="row">{{ __('procedure.table.name') }}</th>
        <td>{{ $procedure->duration }}</td>
    </tr>
    <tr>
        <th scope="row">{{ __('procedure.table.price') }}</th>
        <td>{{ $procedure->price }}</td>
    </tr>
    <tr>
        <th scope="row">{{ __('procedure.table.people_count') }}</th>
        <td>{{ $procedure->people_count }}</td>
    </tr>
    </tbody>
</table>
