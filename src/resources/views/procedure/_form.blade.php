<?php
/**
 * @var \App\Models\Procedure $procedure
 */

$route = $procedure->id ? 'procedure.update' : 'procedure.store';
$route_params = $procedure->id ? ["procedure" => $procedure->id] : [];
$method = $procedure->id ? "PATCH" : "POST";
?>

@extends('blocks._form')

@section('form_content')
    <div class="form-group">
        <label for="name">{{ __('forms.procedure.add.name') }}</label>
        <input type="text" class="form-control" name="name" value="{{ $procedure->name }}">
    </div>

    <div class="form-group">
        <label for="duration">{{ __('forms.procedure.add.duration') }}</label>
        <input type="number" class="form-control" name="duration" value="{{ $procedure->duration }}">
    </div>

    <div class="form-group">
        <label for="price">{{ __('forms.procedure.add.price') }}</label>
        <input type="number" class="form-control" name="price" value="{{ $procedure->price }}">
    </div>

    <div class="form-group">
        <label for="people_count">{{ __('forms.procedure.add.people_count') }}</label>
        <input type="number" class="form-control" name="people_count" value="{{ $procedure->people_count }}">
    </div>

    <div class="form-group text-right py-4">

        <button type="submit" class="btn btn-primary">
            {{ $procedure->id ? __('buttons.procedure.edit') : __('buttons.procedure.add') }}
        </button>
    </div>
@stop
