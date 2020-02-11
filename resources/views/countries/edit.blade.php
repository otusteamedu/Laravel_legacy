@extends('layouts.inner')

@section('title', $country['name'])
@section('h1', $country['name'])
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-xs-12 col-md-6">
            @include('blocks.forms.model', [
                'entity_name' => [
                     's' => 'country',
                     'm' => 'countries',
                ],
                'submit_text' => __('admin.save'),
                'fields' => config('form.country'),
                'values' => $country,
            ])
        </div>
    </div>
@endsection