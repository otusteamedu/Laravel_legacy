@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Список стран
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Список стран</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                @include('cms.countries.blocks.header.list', ['country' => $country])
                @include('cms.countries.blocks.cities-list.index', ['country' => $country, 'cities' => $cities])
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
