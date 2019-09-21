@extends('layout._layout')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Group</li>
</ol>
@stop

@section('content')

<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Создание группы</div>
        <div class="card-body card-block">
            <form action="{{route('admin.groups.update', $group)}}" method="post" class="">
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="name" name="name" placeholder="Название группы" class="form-control" value="{{$group->name}}">
                    </div>
                </div>
                <div class="form-actions form-group"><button type="submit" class="btn btn-success btn-sm">Сохранить изменения</button></div>
            </form>
        </div>
    </div>
</div>
@stop