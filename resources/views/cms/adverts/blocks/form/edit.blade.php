
<form method="post" action="/adverts/{{$advert->id}}">
    {{ csrf_field() }}
    <div class="form-group">
        <h1> Редактирование объявления</h1>

        <p>Подразделение: {{$advert->division->name}}</p>
        <p>Городо: {{$advert->town->name}}</p>

        <label >Заголовок</label>
        <input type="text" name="title" value="{{$advert->title}}" class="form-control" >

        <label >Цена</label>
        <input type="text" name="price" value="{{$advert->price}}" class="form-control" >

        <label >Описание</label>
        <input type="text" name="description" value="{{$advert->description}}" class="form-control" >

        <input type="hidden" name="town_id" value="{{$advert->town_id}}">
        <input type="hidden" name="division_id" value="{{$advert->division_id}}">

        <input type="hidden" name="_method" value="PUT">

    </div>

    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
