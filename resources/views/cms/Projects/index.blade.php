<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Название</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $value)
        <tr>
            <th scope="row">{{$value->id}}</th>
            <td>{{$value->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>


{{ $data->links() }}



