@extends('layouts.page_personal')


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
            <strong class="card-title">Студент</strong>
        </div>
        <div class="card-body">
            {{$student->name}}
            <br>
            @foreach($student->users as $user)
            {{$user->name}},
            @endforeach
        </div>
    </div>
</div>
@stop