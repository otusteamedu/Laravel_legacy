@extends('layouts.app')

@section('title', 'Page Title ')

<?php
$arUsers = $users->mapWithKeys(static function ( $user) {
    return [
        $user->id => $user->name
    ];
})->toArray();

$arStatuses = $statuses->mapWithKeys(static function ( $status) {
    return [
        $status->id => $status->name
    ];
})->toArray();
?>

@section('content')
    {{ Form::open(['url' => route('admin.journals.store')]) }}

    <div class="form-group">

        {{Form::label('user', 'Пользователь')}}
        {{Form::select('user_id',$arUsers, null, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">

        {{Form::label('status', 'Статус')}}
        {{Form::select('status_id',$arStatuses, null, ['class' => 'form-control'])}}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
