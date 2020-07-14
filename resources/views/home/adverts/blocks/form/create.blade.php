
<form method="post" action="{{route('home.store', ['locale'=>$locale])}}">
    {{ csrf_field() }}
    <div class="form-group">

        <select class="custom-select " required name="division_id">
            <option value="selected">Подразделение</option>
            @foreach ($divisionList->items as $item)
            <option value="{{$item->id ?? ''}}">{{$item->name ?? ''}}</option>
            @endforeach
        </select>
        <br><br>
        <select class="custom-select " required name="town_id">
            <option value="selected">Город</option>
            @foreach ($townList->items as $item)
                <option value="{{$item->id ?? ''}}">{{$item->name ?? ''}}</option>
            @endforeach
        </select>
        <br><br>
        <label >Заголовок</label>
        <input type="text" name="title" class="form-control" >

        <label >Цена</label>
        <input type="text" name="price" class="form-control" >

        <label >Описание</label>
        <input type="text" name="content" class="form-control" >

    </div>

    <button type="submit" class="btn btn-primary">Добавить</button>
</form>


