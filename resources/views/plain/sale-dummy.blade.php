@extends('plain.layout')

@section('header-styles')
    <link rel="stylesheet" href="css/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="css/badum.css">
@endsection

@section('header-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/jquery.arcticmodal-0.3.min.js"></script>
    <script src="js/inputmask.min.js"></script>
    <script src="https://yastatic.net/share2/share.js" async="async"></script>
    <script src="js/badum.js"></script>
@endsection

@section('title')Каталог предложений@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">

            <div class="header">
                <h1>Каталог предложений</h1>
                @include('plain.blocks.header-sub')
            </div>

            @include('plain.blocks.search-form')


            <div class="hash-tags js-tags">
                @include('plain.blocks.tags')
            </div>

            <div class="sale-list">
                @include('plain.blocks.sale-list-dummy')
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>
@endsection

@section('hidden-content')
    @include('plain.blocks.hidden-dummy')
@endsection
