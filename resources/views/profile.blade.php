@extends('layouts.base')

@section('title', __('menu.profile'))
@php(
$userInfo = [
    'name' => 'Владимир',
    'surname' => 'Шамаринов',
    'email' => 'vo_vann@mail.ru',
    'birthdate' => '16.04.1984',
    'coutry' => 'Россия',
    'city' => 'Санкт-Петербург',
    ]
)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <h1>@lang('menu.profile')</h1>
            </div>
        </div>

        @include('blocks.forms.simple', ['formData' => $userInfo, 'langModule' => 'profile'])

        <div class="row">
            <div class="col-sm-4 col-md-4">
                <a class="btn btn-primary btn-lg" href="/save" role="button">@lang('profile.save')</a>
            </div>
        </div>

    </div>
@endsection
