<br>
<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Наименование</th>
        <th scope="col">Описание</th>
        <th scope="col">Кнопки</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($divisionList as $Item)
        <tr>
            <th scope="row">{{$Item->id}}</th>
            <td>{{$Item->name}}</td>
            <td>Description</td>

            <td>
                <div class="container">
                    <div class="row">
                        <a class="btn btn-primary mr-1" href="/divisions/{{$Item->id}}">VIEW</a>
                        <a class="btn btn-warning mr-1" href="/divisions/{{$Item->id}}/edit">UPD</a>
                        @include('cms.divisions.blocks.form.delete', ['id'=>$Item->id])
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
