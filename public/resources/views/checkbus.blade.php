@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h3></h3>
        </div>
        <div>
            <form action="/check" method="post">
                @csrf
                <div class="form-group">
                    <label for="register">Регистрационный номер</label>
                    <input type="text" id="register" name="register" class="form-control">
                </div>
                <div class="form-group">
                    <label for="date">Дата</label>
                    <input type="date"
                           class="form-control"
                           id="date"  name="date"
                           placeholder=" date">
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Проверить</button>
            </form>
        </div>
    </div>
@endsection


