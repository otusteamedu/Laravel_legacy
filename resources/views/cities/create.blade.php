@extends('layouts.inner')

@section('title', __('admin.create'))
@section('h1', __('admin.create'))
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-xs-12 col-md-6">
            @include('blocks.forms.default', [
                'url' => route('admin.cities.store'),
                'entity_name' => [
                     's' => 'city',
                     'm' => 'cities',
                ],
                'submit_text' => __('admin.save'),
                'fields' => config('form.city'),
                'values' => [],
            ])
        </div>
    </div>
@endsection