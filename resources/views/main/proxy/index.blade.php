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
                <div class="col d-flex flex-row justify-content-end align-items-center">
                    <a href="{{ route('proxy.create') }}" class="btn btn-primary">@lang('proxy.add')</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>IP</th>
                            <th>@lang('proxy.form.port')</th>
                            <th>@lang('proxy.form.type')</th>
                            <th>@lang('proxy.form.login')</th>
                            <th>@lang('proxy.form.password')</th>
                            <th>Редактировать</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        @foreach ($proxies as $proxy)
                            <tr>
                                <td>{{ $proxy->ip }}</td>
                                <td>{{ $proxy->port }}</td>
                                <td>{{ $proxy->type }}</td>
                                <td>{{ $proxy->login }}</td>
                                <td>{{ $proxy->password }}</td>
                                <td>
                                    <a href="{{ route('proxy.delete', Array('proxy' => $proxy )) }}" class="btn btn-danger">Удалить</a>
                                </td>
                                <td>
                                    <a href="{{ route('proxy.edit', Array('proxy' => $proxy)) }}" class="btn btn-primary">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
