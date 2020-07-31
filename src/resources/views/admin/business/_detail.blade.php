<a href="{{ route('admin.business.edit', ['business' => $business->id]) }}"
   class="btn btn-outline-info"><i class="fa fa-pen-alt"></i> Edit</a>

<form action="{{ route('admin.business.destroy', $business->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-outline-danger" title="Delete">
        <i class="fa fa-trash-alt"></i> Delete
    </button>
</form>

<table class="table table-hover mt-4">
    <tbody>
    <tr>
        <th scope="row">id</th>
        <td>{{ $business->id }}</td>
    </tr>
    <tr>
        <th scope="row">Name</th>
        <td>{{ $business->name }}</td>
    </tr>
    <tr>
        <th scope="row">Username</th>
        <td>{{ $business->user->name }}</td>
    </tr>
    <tr>
        <th scope="row">Type</th>
        <td>{{ $business->type->name }}</td>
    </tr>
    </tbody>
</table>
