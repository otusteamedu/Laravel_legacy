<?php include (__DIR__.'/../../../resources/views/demo..php')?>
@extends('layouts.authors.profile.index')
@section('content')
    <div class="row">
        <div class="col">
            @include('blocks.cards.users.authors.statistics.index')
        </div>
        <div class="col">
            @include('blocks.cards.users.authors.statistics.recipes.index')
        </div>
        <div class="col">
            @include('blocks.cards.users.authors.statistics.comments.index')
        </div>
    </div>
    @include('blocks.cards.users.authors.details.owner.index')
@endsection
