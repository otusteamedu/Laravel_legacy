
<form method="post" action="/messages">
    {{ csrf_field() }}
    <div class="form-group">

        <input type="text" name="advert_id" class="form-control mb-1" placeholder="id объявления" >
        <input type="text" name="content" class="form-control" placeholder="Текст сообщения">

    </div>

    <button type="submit" class="btn btn-primary">Добавить</button>
</form>


