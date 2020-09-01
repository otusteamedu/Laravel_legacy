
<form method="post" action="/messages/{{$message->id}}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Редактирование сообщения</label>
        <input type="text" name="content" class="form-control" value="{{$message->content ?? ''}}" aria-describedby="Help">
        <input type="hidden" name="advert_id" value="{{$message->advert_id ?? ''}}">
        <input type="hidden" name="url" value="{{$url ?? ''}}">

        <input type="hidden" name="_method" value="PUT">
        <small id="Help" class="form-text text-muted">Отредактируйте сообщение и нажмите обновить</small>
    </div>

    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
