@extends('layouts.main.index')

@section('class', 'page-account text-page')

@section('title', \App\Services\PageHelper::generateTitle(__('account.page-title')))

@section('content')
    <div class="container">
        <div class="content">

            <div class="row">
                <div class="col">
                    <h1>@lang('account.page-h1')</h1>
                </div>
                <div class="col d-flex flex-row justify-content-end align-items-center">
                    <a href="{{ route('account.create') }}" class="btn btn-primary">@lang('account.add')</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>IP</th>
                            <th>@lang('account.form.login')</th>
                            <th>@lang('account.form.password')</th>
                            <th>Редактировать</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        @foreach ($accounts as $account)
                            <tr>
                                <td>{{ $account->login }}</td>
                                <td>{{ $account->password }}</td>
                                <td>
                                    <a href="{{ route('proxy.delete', Array('proxy' => $account )) }}" class="btn btn-danger">Удалить</a>
                                </td>
                                <td>
                                    <a href="{{ route('proxy.edit', Array('proxy' => $account)) }}" class="btn btn-primary">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
