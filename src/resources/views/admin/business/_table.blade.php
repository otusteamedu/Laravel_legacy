<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Пользователь</th>
        <th scope="col">Тип</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($businesses as $business)
    <tr>
        <th scope="row">{{ $business->id }}</th>
        <td>{{ $business->user->name }}</td>
        <td>{{ $business->type->name }}</td>
        <td>
            <a href="{{ route('admin.business.show', ['business' => $business->id]) }}"
               class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>

            <a href="{{ route('admin.business.edit', ['business' => $business->id]) }}"
               class="btn btn-sm btn-outline-info"><i class="fa fa-pen-alt"></i></a>

            <form action="{{ route('admin.business.destroy', $business->id) }}" method="POST" class="d-inline">
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
