@extends('layouts.inner')

@section('title', $city['name'])
@section('h1', $city['name'])
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-xs-12 col-md-6">
            @include('blocks.forms.model', [
                'entity_name' => [
                     's' => 'city',
                     'm' => 'cities',
                ],
                'submit_text' => __('admin.save'),
                'fields' => config('form.city'),
                'values' => $city,
            ])
        </div>
    </div>
@endsection