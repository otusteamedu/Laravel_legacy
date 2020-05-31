
<form method="post" action="/towns">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">Новый город</label>
        <input type="text" name="name" class="form-control" aria-describedby="Help">
        <small id="Help" class="form-text text-muted">Введите новый населенный пункт и нажмите добавить</small>
    </div>

    <button type="submit" class="btn btn-primary">Добавить</button>
</form>


