<?php
/**
 * @var bool $create
 * @var \App\Models\Business $business
 */

$route = $business->id ? 'admin.business.update' : 'admin.business.store';
$route_params = $business->id ? ["business" => $business->id] : [];
$method = $business->id ? "PATCH" : "POST";
$button_text = $business->id ? "Сохранить" : "Отправить";
?>

@extends('admin.blocks._form')

@section('form_content')
    <div class="form-group">
        <label for="user_id">Пользователь</label>

        <!-- TODO: Использовать селект с плагином select2 для поиска по пользователям -->

        <input type="text" class="form-control" name="user_id" value="{{ $business->user_id }}">
    </div>

    <div class="form-group">
        <label for="type_id">Тип</label>
        <select class="form-control" name="type_id">
            @forelse($businessTypes as $type)
                <option value="{{ $type->id }}"
                    {{ $business->type_id == $type->id ? "selected" : "" }}>
                    {{ $type->name }}
                </option>
            @empty
                <option value="null" disabled>Ошибка загрузки типов</option>
            @endforelse
        </select>
    </div>

    <div class="form-group">
        <label for="status">Статус</label>
        <select class="form-control" name="status">
            <option value="<?= \App\Models\Business::STATUS_REGISTERED ?>"
                {{ $business->user_id == \App\Models\Business::STATUS_REGISTERED ? "selected" : "" }}>
                Зарегистрирован
            </option>
            <option value="<?= \App\Models\Business::STATUS_CONFIRMED ?>"
                {{ $business->user_id == \App\Models\Business::STATUS_CONFIRMED ? "selected" : "" }}>
                Подтвержден
            </option>
            <option value="<?= \App\Models\Business::STATUS_BLOCKED ?>"
                {{ $business->user_id == \App\Models\Business::STATUS_BLOCKED ? "selected" : "" }}>
                Заблокирован
            </option>
        </select>
    </div>
@stop
