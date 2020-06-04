@extends('layouts.app')

@php
    $book =
        [
            'title'=>'Title 1',
            'annotation'=>'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
            'table_of_content'=>[['title'=>'Title 0','items'=>[['title'=>"Title1", 'page'=>1,'items'=>[]],['title'=>"Title2", 'page'=>12,'items'=>[]]]]]
        ]
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <row class="col-4">
                <div style="max-height: 33vh">
                    <book-card :book='@json($book)'/>
                </div>
            </row>
            <row class="col">
                @each('blocks.book.table_of_content_item', $book['table_of_content'], 'item', 'blocks.book.empty_table_of_content')
                ... and so on
            </row>
        </div>
    </div>
@endsection
