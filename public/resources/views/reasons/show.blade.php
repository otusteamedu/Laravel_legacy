@extends('layout._layout')


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
            <strong class="card-title">Просмотр тветственности</strong>
        </div>
        <div class="card-body">
            {{$reason->name}}
            <br>
            {{$reason->amount}}
            <br>
            {{$group[0]->name}}
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




                @forelse ($responsibilities as $responsibility)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$responsibility->name}}</td>
                    <td>{{$reason->amount}}</td>
                    <td>сдал/не сдал</td>
                    <td>
                        <form action="{{route('admin.flows.store')}}" method="post" class="">
                            {{csrf_field()}}
                            <input type="hidden" name="cash" value="{{$reason->amount}}">
                            <input type="hidden" name="operation" value="1">
                            <input type="hidden" name="reason_id" value="{{$reason->id}}">
                            <input type="hidden" name="responsibility_id" value="{{$responsibility->id}}">

                            <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Сдал</button></div>
                        </form>
                    </td>
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