@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Каталог предложений
@endsection

@section('content')
    @include('plain.blocks.header')

    <main>
        <div class="wrapper">

            <div class="header">
                <h1>Каталог предложений</h1>
                @include('plain.blocks.header-sub')
            </div>

            @include('plain.blocks.search-form')

            @include('plain.blocks.tags', $categories)

            @include('plain.blocks.sale-list', $offers)
        </div>
    </main>

    @include('plain.blocks.footer')
@endsection
