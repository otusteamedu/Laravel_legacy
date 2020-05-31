
<form method="post" action="/towns/{{$town->id}}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Редактирование города</label>
        <input type="text" name="name" class="form-control" value="{{$town->name ?? ''}}" aria-describedby="Help">
        <input type="hidden" name="_method" value="PUT">
        <small id="Help" class="form-text text-muted">Отредактируйте населенный пункт и нажмите обновить</small>
    </div>

    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
