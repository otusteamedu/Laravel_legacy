@extends('layouts.app')

@php
    $genres = [
    [
        'name'=>"Humor",
        'subGenres'=>[
            [
                'name'=>'Humor 1',
            ],
            [
                'name'=>'Humor 2',
            ],
            [
                'name'=>'Humor 3',
            ],
        ]
    ],
        [
        'name'=>"Cyberpank",
        'subGenres'=>[
            [
                'name'=>'Cyberpank 1',
            ],
            [
                'name'=>'Cyberpank 2',
            ],
            [
                'name'=>'Cyberpank 3',
            ],
        ]
    ]
];

$books = [
    ['title'=>'Title 1','annotation'=>'Some quick example text to build on the card title and make up the bulk of the card\'s content.'],
    ['title'=>'Title 2','annotation'=>'Some quick example text to build on the card title and make up the bulk of the card\'s content.'],
    ['title'=>'Title 3','annotation'=>'Some quick example text to build on the card title and make up the bulk of the card\'s content.'],
    ['title'=>'Title 4','annotation'=>'Some quick example text to build on the card title and make up the bulk of the card\'s content.'],
    ['title'=>'Title 5','annotation'=>'Some quick example text to build on the card title and make up the bulk of the card\'s content.'],
    ['title'=>'Title 6','annotation'=>'Some quick example text to build on the card title and make up the bulk of the card\'s content.'],
];

@endphp

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <search-bar :genres='@json($genres)'/>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6">
            @foreach($books as $book)
                <div class="col">
                    <book-card :book='@json($book)' link="/book"/>
                </div>
            @endforeach
        </div>
    </div>
@endsection
