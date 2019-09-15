@extends('layouts.app')

@section('content')
    <main role="main" class="inner cover"  style="margin-top:100px;">
        <h1 class="h3 mb-3 font-weight-normal">Расписание</h1>
        <form action="/" method="post">
            @csrf
            <input type="date"
                   class="form-control"
                   id="date1"
                   name="date1"
                   value="2019-08-01"
                   min="2018-11-01"
                   max="2019-11-01" required autofocus>
        <label for="date1" class="sr-only">Начальная дата</label>
            <input type="date"
                   class="form-control"
                   id="date2"
                   name="date2"
                   value="2019-08-31"
                   min="2018-08-01"
                   max="2019-11-30">
            <label for="date2" class="sr-only">Конечная дата</label>
            <input type="hidden"
                   name="hidden_id"
                   value="0">
            <br><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Показать</button>
    </form>
    </main>
@endsection
