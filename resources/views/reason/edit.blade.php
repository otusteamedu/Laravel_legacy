@extends('layouts.page_personal')


<!--@section('breadcrumbs')-->
<!--<ol class="breadcrumb text-right">-->
<!--    <li><a href="#">Dashboard</a></li>-->
<!--    <li class="active">Причина</li>-->
<!--</ol>-->
<!--@stop-->


@section('content')

<div class="col-lg-6">
    <div class="card">
        <div class="card-header">Редактирование причины</div>
        <div class="card-body card-block">
            <form action="{{route('admin.reason.update', ['locale'=>$locale, 'reason'=>$reason])}}" method="post" class="">
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="name" name="name" placeholder="Имя" class="form-control" value="{{$reason->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" id="amount" name="amount" placeholder="Сумма" class="form-control" value="{{$reason->amount}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Описание</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" placeholder="Описание" rows="3">{{$reason->description}}</textarea>
                </div>

                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success btn-sm">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop