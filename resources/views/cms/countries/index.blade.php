@extends('plain.layout')

@section('header-styles')
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="../../css/big-sale.css">
    <link rel="stylesheet" href="../../css/base-laravel-style.css">
@endsection

@section('header-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../../js/jquery.arcticmodal-0.3.min.js"></script>
    <script src="../../js/inputmask.min.js"></script>
    <script src="https://yastatic.net/share2/share.js" async="async"></script>
    <script src="../../js/big-sale.js"></script>
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
                @include('plain.blocks.header-sub-cms')
            </div>

            <div class="content">
                @include('cms.countries.blocks.list.index')
            </div>
        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
