@extends('public.layouts.public')

@section('pageTitle', __('public.account.ordered'))

@section('pageHeader', __('public.account.ordered'))

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home'),
        ], [
            'url' => \route('public.account.index'),
            'title' => __('public.account.index'),
        ], [
            'url' => \route('public.account.ordered'),
            'title' => __('public.account.ordered'),
        ]
    ];
@endphp

@section('pageContent')
    @if(count($ordersList) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-sm" role="list">
                <thead>
                    <tr>
                        <th>@lang('public.order.number')</th>
                        <th>@lang('public.order.ordered_at')</th>
                        <th width="120">@lang('public.order.total')</th>
                        <th width="200">@lang('public.order.status')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($ordersList as $item)
                    <tr>
                        <td>
                            <a href="{{ route('public.account.order', ['number' => $item['number']]) }}">{{ $item['number'] }}</a>
                        </td>
                        <td>{{ $item['ordered_at'] }}</td>
                        <td><div class="text-center p-1 text-white bg-secondary"><b>{{ $item['total'] }} руб.</b></div></td>
                        <td><div class="text-center p-1 text-white @if($item['status'] == 'done') bg-success @elseif($item['status'] == 'confirmed') bg-primary @elseif($item['status'] == 'canceled') bg-danger @endif ">@lang('public.order.status_'.$item['status'])</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="list-empty alert alert-danger">
            @lang('admin.listempty')
        </div>
    @endif
    <br /><br />
    <a href="{{ route('public.account.index') }}" class="btn btn-primary">@lang('public.go_back')</a>
@endsection
