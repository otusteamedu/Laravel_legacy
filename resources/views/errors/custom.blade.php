@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    exception has occurred
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <index.blade.phph1> exception has occurred</index.blade.phph1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">

                <h2>
                    Exception details: <b>{{ $message }}</b>
                </h2>
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
