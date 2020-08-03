<?php
$route = $business->id ? 'business.update' : 'business.store';
$route_params = $business->id ? ["business" => $business->id] : [];
$method = $business->id ? "PATCH" : "POST";
?>

@extends('blocks._form')

@section('form_content')
    <div class="form-group">
        <label for="name">{{ __('forms.business.add.name') }}</label>
        <input type="text" class="form-control" name="name" value="{{ $business->name }}">
    </div>

    <div class="form-group">
        <label for="type_id">{{ __('forms.business.add.type_id') }}</label>
        <select class="form-control" name="type_id">
            @foreach($businessTypes as $type)
                <option value="{{ $type->id }}"
                    {{ $business->type_id == $type->id ? "selected" : "" }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group text-right py-4">

        <button type="submit" class="btn btn-primary">
            {{ $business->id ? __('buttons.business.edit') : __('buttons.business.add') }}
        </button>
    </div>
@stop
