<a href="{{ route('admin.procedure.edit', ['procedure' => $procedure->id]) }}"
   class="btn btn-outline-info"><i class="fa fa-pen-alt"></i> Edit</a>

<form action="{{ route('admin.procedure.destroy', $procedure->id) }}" method="POST" class="d-inline">
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
        <td>{{ $procedure->id }}</td>
    </tr>
    <tr>
        <th scope="row">Name</th>
        <td>{{ $procedure->name }}</td>
    </tr>
    <tr>
        <th scope="row">Business ID</th>
        <td>{{ $procedure->business_id }}</td>
    </tr>
    <tr>
        <th scope="row">Worker name</th>
        <td>{{ $procedure->worker->name }}</td>
    </tr>
    <tr>
        <th scope="row">Duration</th>
        <td>{{ $procedure->duration }}</td>
    </tr>
    <tr>
        <th scope="row">Price</th>
        <td>{{ $procedure->price }}</td>
    </tr>
    <tr>
        <th scope="row">People count</th>
        <td>{{ $procedure->people_count }}</td>
    </tr>
    </tbody>
</table>
