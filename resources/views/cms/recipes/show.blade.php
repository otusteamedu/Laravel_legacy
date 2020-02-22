<?php include (__DIR__.'/../../../resources/views/demo..php')?>
@extends('layouts.client.index')
@section('content')
    <div class="row mt-3">
        <div class="col-12">
            @include('blocks.cards.recipes.detail.index')
            <h3 class="mt-5">{{__('titles.recipes.steps')}}</h3>
            @foreach($recipe['steps'] as $step)
                @php($step['image'] =  sprintf('/images/%s.jpg', rand(1, 2)))
                @php($step['description'] = $faker->realText(rand(100, 250)))
                @include('blocks.cards.recipes.step.index')
            @endforeach
        </div>
        <div class="col-12 mt-5">
            @include('blocks.forms.comments')
        </div>
        <div class="col-12 mt-3">
            @foreach($recipe['comments'] as $comment)
                <div class="mt-3">
                    @include('blocks.cards.comments.index')
                </div>
            @endforeach
        </div>
    </div>
@endsection
