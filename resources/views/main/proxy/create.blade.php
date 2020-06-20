@extends('layouts.main.index')

@section('class', 'page-proxy text-page')

@section('title', \App\Services\PageHelper::generateTitle(__('proxy.page-title')))

@section('content')
    <div class="container">
        <div class="content">

            <div class="row">
                <div class="col">
                    <h1>@lang('proxy.page-h1')</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @include('main.proxy.components.forms.create')
                </div>
            </div>
        </div>
    </div>
@endsection
