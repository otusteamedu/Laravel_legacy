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
            <strong class="card-title">Просмотр группы</strong>
        </div>
        <div class="card-body">
            {{$group->name}}
        </div>
    </div>
</div>
@stop