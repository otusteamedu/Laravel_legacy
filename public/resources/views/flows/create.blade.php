@extends('layout._layout')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Поток</li>
</ol>
@stop

@section('content')
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Создание операции с потоком</div>
        <div class="card-body card-block">
            <form action="{{route('admin.flows.store')}}" method="post" class="">
                {{csrf_field()}}

                <input type="hidden" name="reason_id" value="0">
                <input type="hidden" name="responsibility_id" value="0">

                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Группа</label></div>
                    <div class="col-12 col-md-9">
                        <select name="group_id" id="select" class="form-control">
                            @foreach ($groups as $group)
                            <option value="{{$group->id}}"
                            @if($group->id == $group_id) selected @endif
                            >{{$group->name}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Направление</label></div>
                    <div class="col-12 col-md-9">
                        <select name="operation" id="select" class="form-control">
                            <option value="1" selected >Приход</option>
                            <option value="2">Расход</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="cash" name="cash" placeholder="Сумма" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="text" name="text" placeholder="Описание" class="form-control">
                    </div>
                </div>

                <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Создать</button></div>
            </form>
        </div>
    </div>
</div>
@stop