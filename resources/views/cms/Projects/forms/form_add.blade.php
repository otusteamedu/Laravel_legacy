<form action="{{route('csm.projects.store')}}" method="POST">
    <div class="form-group">
        <label for="name">Урл проекта</label>
        <input type="text" name="name" class="form-control"  value="{{Request::flash('name')}}" placeholder="Введите урл проекта">
    </div>
    <div class="form-group">
        <label for="description">Описание</label>
        <input type="text" name="description" class="form-control"  value="{{old('description')}}" placeholder="Введите описание проекта">
    </div>
    <div class="form-group">
        <label for="description">День отчета</label>
        <input type="text" name="report_day" class="form-control"  placeholder="Введите дату отчета (число)">
    </div>
@csrf
    <button type="submit" class="btn btn-success">Добавить</button>
</form>
