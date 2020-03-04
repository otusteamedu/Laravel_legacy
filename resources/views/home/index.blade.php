<?php include (__DIR__.'/../../../resources/views/demo..php')?>
@extends('layouts.recipes.index')
@section('content')
    @include('blocks.search.recipes')
    <div class="row mt-3">
        <h1 class="col-12 col-lg-6">{{__('titles.recipes.new')}}</h1>
        <div class="col">
            @include('blocks.sorts.recipes.index')
        </div>
        @foreach($recipes as $recipe)
            <div class="col-auto mt-3">
                @include('blocks.cards.recipes.preview.index')
            </div>
        @endforeach
    </div>
@endsection
