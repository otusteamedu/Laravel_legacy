@extends('admin.layouts.admin')
@section('content')
    <h1>
        Добавить страницу
    </h1>
    <hr>
    <form class="">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Название" id="name">
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-sm-2 col-form-label">Содержание</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="content" rows="13" placeholder="Содержание"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранть</button>
    </form>
@endsection
