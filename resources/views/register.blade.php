@extends('layouts.base')

@section('title', __('menu.register'))

@php(
$userInfo = [
    'name' => '',
    'surname' => '',
    'email' => '',
    'birthdate' => '',
    'coutry' => '',
    'city' => '',
    ]
)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <h1>@lang('menu.register')</h1>
            </div>
        </div>

        @include('blocks.forms.simple', ['formData' => $userInfo, 'langModule' => 'profile'])

        <div class="row">
            <div class="col-sm-4 col-md-4">
                <a class="btn btn-primary btn-lg" href="/save" role="button">@lang('profile.register')</a>
            </div>
        </div>
    </div>
@endsection
