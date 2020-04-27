@extends('layouts.page_personal')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Group</li>
</ol>
@stop

@section('content')


<div class="col-lg-9">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Просмотр ответственности</strong>
        </div>
        <div class="card-body">
            {{$reason->name}}
            <br>
            {{$reason->amount}}
            <br>
            {{$reason->description}}
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <strong class="card-title">Список участников</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Состояние</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>


                @forelse ($students as $student)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$student->name}}</td>
                    <td>{{$reason->amount}}</td>
                    <td>сдал/не сдал</td>
                    <td></td>
                </tr>
                @empty
                <tr>
                    <th scope="row">-</th>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@stop