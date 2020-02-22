<?php include(__DIR__ . '/../../../resources/views/demo..php') ?>
@extends('layouts.client.index')
@section('content')
    <div class="row mt-3">
        <h1 class="col-12">{{__('titles.authors.ratings')}}</h1>

        @foreach($ratings['authors'] as $author)
            <div class="mt-1 col-12">
                @include('blocks.cards.users.authors.ratings.index')
            </div>
        @endforeach
    </div>
@endsection
