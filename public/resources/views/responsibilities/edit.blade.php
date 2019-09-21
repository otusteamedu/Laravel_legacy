@extends('layout._layout')


@section('breadcrumbs')
<ol class="breadcrumb text-right">
    <li><a href="#">Dashboard</a></li>
    <li class="active">Ответственности</li>
</ol>
@stop


@section('content')

<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Редактирование ответственности</div>
        <div class="card-body card-block">
            <form action="{{route('admin.responsibilities.update', $responsibility)}}" method="post" class="">
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}

                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Select</label></div>
                    <div class="col-12 col-md-9">
                        <select  class="form-control" name="group_id">
                            @foreach ($groups as $group)
                            <option value="{{$group->id}}" @if($group->id ==$responsibility->group_id)selected="selected" @endif>{{$group->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="name" name="name" placeholder="Имя" class="form-control" value="{{$responsibility->name}}">
                    </div>
                </div>

                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success btn-sm">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop