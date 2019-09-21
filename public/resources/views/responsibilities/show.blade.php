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
            {{$responsibility->name}}
            <br>
            {{$group[0]->name}}
        </div>
    </div>
</div>
@stop