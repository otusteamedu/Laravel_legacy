<br>
<div class="container">

    <div class="row">
        <div class="col-md-4 border rounded ">
            <img src="{{ URL::asset('img/default.jpg') }}" class="card-img-top" alt="...">
            <h5>#{{$advert->id}} - {{$advert->userName}} (id: {{$advert->user_id}})</h5>
            <h3>{{$advert->title}}</h3>
            <h3 class="mb-3">Цена: {{$advert->price}} р.</h3>
            <p>{{$advert->content}}</p>
            <img src="{{$advert->img}}" alt="">
            <span>{{$advert->created_at}}</span> |
            <span>{{$advert->updated_at}}</span>
        </div>

        <div class="col-md-4 border rounded ml-auto">
            @foreach ($advert->messages as $item)
                <p class="mt-3 border-bottom"><mark>#{{$item->id ?? ''}} - {{$item->user->name ?? ''}}</mark></p>
                <p class="blockquote text-right">{{$item->content ?? ''}} </p>
                <div class="row">

                    @can('messageUpdate', $item)
                        <a class="btn ml-auto" href="/messages/{{$item->id ?? ''}}/edit">&#9998;</a>
                        @include('cms.messages.blocks.form.delete', ['id'=>$item->id ?? ''])
                    @endcan
                </div>
            @endforeach

            <form method="post" action="/messages">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" name="advert_id" class="form-control mb-1" value="{{$advert->id ?? ''}}">
                    <input type="text" name="content" class="form-control" placeholder="Текст сообщения">
                </div>

                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>

    </div>

    @can('advertUpdate', $advert)
    <div class="row mt-3">
        <a class="btn btn-warning mr-1" href="/adverts/{{$advert->id}}/edit">Update</a>
        @include('cms.adverts.blocks.form.delete', ['id'=>$advert->id])
    </div>
    @endcan

</div>
