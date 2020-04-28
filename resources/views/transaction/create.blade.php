@extends('layouts.page_personal')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Причина</li>
</ol>
@stop

@section('content')
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Создание транзакции</div>
        <div class="card-body card-block">
            <form action="{{route('admin.transaction.store')}}" method="post" class="">
                {{ csrf_field() }}

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="amount" name="amount" placeholder="Сумма" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select" class=" form-control-label">Родитель</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="user_id" id="select" class="form-control">
                            @foreach ($users as $user)
                            <option value="{{$user->id}}"
                            >{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select" class=" form-control-label">Ученик</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="student_id" id="select" class="form-control">
                            @foreach ($students as $student)
                            <option value="{{$student->id}}"
                            >{{$student->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="select" class=" form-control-label">Причина</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="reason_id" id="select" class="form-control">
                            @foreach ($reasons as $reason)
                            <option value="{{$reason->id}}"
                            >{{$reason->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success btn-sm">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop