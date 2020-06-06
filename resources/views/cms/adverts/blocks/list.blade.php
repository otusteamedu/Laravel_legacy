<br>
<table class="table table-sm table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">U</th>
        <th scope="col">T</th>
        <th scope="col">D</th>
        <th scope="col">Заголовок</th>
        <th scope="col">Цена</th>
{{--        <th scope="col">Контент</th>--}}
        <th scope="col">Обновл</th>
        <th scope="col">action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($advertList as $Item)
        <tr>
            <th scope="row">{{$Item->id}}</th>
            <td>{{$Item->user_id}}</td>
            <td>{{$Item->town_id}}</td>
            <td>{{$Item->division_id}}</td>
            <td>{{$Item->title}}</td>
            <td>{{$Item->price}}</td>
{{--            <td>{{$Item->content}}</td>--}}
            <td>{{$Item->updated_at}}</td>


            <td>
                <div class="container">
                    <div class="row">
                        <a class="btn btn-primary mr-1" href="/adverts/{{$Item->id}}">V</a>
                        <a class="btn btn-warning mr-1" href="/adverts/{{$Item->id}}/edit">U</a>
                        @include('cms.adverts.blocks.form.delete', ['id'=>$Item->id])
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
