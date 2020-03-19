@extends('layouts.app')
<?php /** @var \App\Model\Menu\Link $link */?>
@section('content')
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-4">
                <a class="btn btn-primary" href="{{route('links.index')}}" role="button">@lang('link.system.back_nav_button')</a>
                <a class="btn btn-primary" href="{{route('links.edit', [$link])}}" role="button">@lang('link.system.show_page.edit_nav_button')</a>
            </div>
            <div class="col-md-8">

                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Название поля</th>
                        <th scope="col">Значение</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">@lang('link.system.label.id')</th>
                            <td>{{$link->id}}</td>
                        </tr>
                        <tr>
                            <th scope="row">@lang('link.system.label.type')</th>
                            <td>{{$link->type}}</td>
                        </tr>
                        <tr>
                            <th scope="row">@lang('link.system.label.name')</th>
                            <td>{{$link->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">@lang('link.system.label.route_name')</th>
                            <td>{{$link->route_name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">@lang('link.system.label.disabled')</th>
                            <td>{{$link->disabled?'Да':'Нет'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
