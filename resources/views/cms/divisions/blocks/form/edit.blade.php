
<form method="post" action="/divisions/{{$division->id}}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Редактирование раздела</label>
        <input type="text" name="name" class="form-control" value="{{$division->name ?? ''}}" aria-describedby="Help">
        <input type="hidden" name="_method" value="PUT">
        <small id="Help" class="form-text text-muted">Отредактируйте наименование раздела и нажмите обновить</small>
    </div>

    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
