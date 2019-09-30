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
        <div class="card-header">Создание пользователя</div>
        <div class="card-body card-block">
            <form action="{{route('admin.user_managment.users.store')}}" method="post" class="">
                @include('admin.user_managment.users.form')
            </form>
        </div>
    </div>
</div>
@stop