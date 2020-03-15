@extends('plain.layout')

@section('header-styles')
    @include('plain.blocks.header-styles')
@endsection

@section('header-scripts')
    @include('plain.blocks.header-scripts')
@endsection

@section('title')
    Редактирование страны
@endsection

@section('content')
    <header>
        @include('plain.blocks.header')
    </header>

    <main>
        <div class="wrapper">
            <div class="header">
                <h1>Редактирование страны</h1>
                @include('plain.blocks.header-sub')
            </div>

            <div class="content">
                <div class="edit-data-form">
                    <form class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputName" class="control-label col-xs-2">Название страны</label>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Например: Россия" value="{{$country->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="control-label col-xs-2">Континент</label>
                                <div class="col-xs-10">
                                    <input type="text" class="form-control" id="inputContinentName" placeholder="Например: Евразия" value="{{$country->continent_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-offset-2 col-xs-10">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>

        </div>
    </main>

    <footer>
        @include('plain.blocks.footer')
    </footer>


@endsection
