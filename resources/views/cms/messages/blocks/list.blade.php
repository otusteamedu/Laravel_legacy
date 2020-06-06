<br>
<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Создал</th>
        <th scope="col">Наименование</th>
        <th scope="col">Кнопки</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($messageList as $Item)
        <tr>
            <th scope="row">{{$Item->id}}</th>
            <td>{{$Item->user->name}}</td>
            <td>{{$Item->content}}</td>

            <td>
                <div class="container">
                    <div class="row">
                        <a class="btn btn-primary mr-1" href="/messages/{{$Item->id}}">VIEW</a>
                        <a class="btn btn-warning mr-1" href="/messages/{{$Item->id}}/edit">UPD</a>
                        @include('cms.messages.blocks.form.delete', ['id'=>$Item->id])
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
