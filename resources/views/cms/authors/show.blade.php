<?php include (__DIR__.'/../../../resources/views/demo..php')?>
@extends('layouts.recipes.index')
@section('content')
    @include('blocks.cards.users.authors.preview.index')
    <div class="row">
        <div class="col mt-4"><h2>{{__('titles.recipes.user')}}</h2> </div>
        @foreach($recipes as $recipe)
            <div class="col-auto mt-3">
                @include('blocks.cards.recipes.preview.index')
            </div>
        @endforeach
    </div>
@endsection
