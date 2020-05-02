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
        <div class="card-header">Создание причины</div>
        <div class="card-body card-block">
            <form action="{{route('admin.reason.store', ['locale'=>$locale])}}" method="post" class="">
                {{ csrf_field() }}

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

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Описание</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description" placeholder="Описание" rows="3"></textarea>
                </div>


                <div class="form-actions form-group">
                    <button type="submit" class="btn btn-success btn-sm">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop