<?php
/**
 * @var array $businesses
 * @var \App\Models\Procedure $procedure
 */

$route = $procedure->id ? 'admin.procedure.update' : 'admin.procedure.store';
$route_params = $procedure->id ? ["procedure" => $procedure->id] : [];
$method = $procedure->id ? "PATCH" : "POST";
$button_text = $procedure->id ? "Сохранить" : "Отправить";
?>

@extends('admin.blocks._form')

@section('form_content')
    <div class="form-group">
        <label for="worker_id">Работник</label>

        <!-- TODO: Использовать селект с плагином select2 для поиска по пользователям -->

        <input type="text" class="form-control" name="worker_id" value="{{ $procedure->worker_id }}">
    </div>

    <div class="form-group">
        <label for="name">Имя</label>
        <input type="text" class="form-control" name="name" value="{{ $procedure->name }}">
    </div>

    <div class="form-group">
        <label for="business_id">Салон</label>
        @include("admin.blocks._select", [
            'name' => 'business_id',
            'rows' => $businesses,
            'key' => 'id',
            'key_name' => 'id',
            'selected' => $procedure->id
        ])
    </div>

    <div class="form-group">
        <label for="duration">Продолжительность</label>
        <input type="number" class="form-control" name="duration" value="{{ $procedure->duration }}">
    </div>

    <div class="form-group">
        <label for="price">Цена</label>
        <input type="number" class="form-control" name="price" value="{{ $procedure->price }}">
    </div>

    <div class="form-group">
        <label for="people_count">Кол-во человек</label>
        <input type="number" class="form-control" name="people_count" value="{{ $procedure->people_count }}">
    </div>
@stop
