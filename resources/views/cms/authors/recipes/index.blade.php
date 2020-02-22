<?php include (__DIR__.'/../../../resources/views/demo..php')?>
@extends('layouts.authors.recipes.index')
@section('content')
    <div class="row mt-3">
        <div class="col-5 ml-auto">
            @include('blocks.sorts.recipes.index')
        </div>
        @foreach($recipes as $recipe)
            <div class="col-auto mt-3">
                @include('blocks.cards.recipes.preview.authors.index')
            </div>
        @endforeach
    </div>
@endsection
