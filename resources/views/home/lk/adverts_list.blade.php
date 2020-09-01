<br>
<div class="container">

    <div class="row">
        <div class="col-md-9 ">
            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Дата Обн.</th>
                    <th scope="col">Действие</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($advertList as $Item)
                <tr>
                    <th scope="row">{{$Item->id}}</th>
                    <td>{{$Item->title}}</td>
                    <td>{{number_format($Item->price, 0, ',', ' ')}}р.</td>
                    <td>{{$Item->updated_at}}</td>

                    <td>
                        <div class="container">
                            <div class="row">
                                <a class="btn btn-primary mr-1 " href="/adverts/{{$Item->id}}">V</a>
                                <a class="btn btn-warning mr-1" href="/adverts/{{$Item->id}}/edit">U</a>
                                @include('cms.adverts.blocks.form.delete', ['id'=>$Item->id])
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-3 mr-auto ">
            <div class="">
                <h6>Логин: {{$user_info->name}}</h6>
                <p>Email: {{$user_info->email}}</p>
                <p>Role: {{$user_info->role}}</p>
                <a class="btn btn-link mr-1 btn-sm" href="#">редактировать профиль</a>
            </div>
        </div>

    </div>
</div>

{{$advertList->links()}}

