@extends('layout._layout')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Причина</li>
</ol>
@stop

@section('content')
<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Создание причины</div>
        <div class="card-body card-block">
            <form action="{{route('admin.reasons.store')}}" method="post" class="">
                {{csrf_field()}}

                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Select</label></div>
                    <div class="col-12 col-md-9">
                        <select name="group_id" id="select" class="form-control">
                            @foreach ($groups as $group)

                            <option value="{{$group->id}}">{{$group->name}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="name" name="name" placeholder="Имя" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="amount" name="amount" placeholder="Сумма" class="form-control">
                    </div>
                </div>

                <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Создать</button></div>
            </form>
        </div>
    </div>
</div>
@stop