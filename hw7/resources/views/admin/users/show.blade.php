@extends('layouts.layout')

@section('title', __('messages.products'))

@section('content')
    <div class="container">
        @include('countries.blocks.header.show', ['country' => $country])
        @include('countries.blocks.cities-list.index', ['country' => $country, 'cities' => $cities])
    </div>
@endsection
