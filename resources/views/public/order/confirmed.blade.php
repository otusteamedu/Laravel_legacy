@extends('public.order.layout')

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home'),
        ], [
            'url' => \route('public.order.confirmed'),
            'title' => __('public.menu.checkout'),
        ]
    ];

@endphp

@section('pageTitle')
    @lang('public.order.status')
@endsection

@section('pageHeader')
    @lang('public.order.status')
@endsection

@section('pageContentMain')
    @if ($errors->messages->any())
        <div class="alert alert-danger small">
            @foreach ($errors->messages->all() as $error)
                {!! $error !!}<br />
            @endforeach
        </div>
    @endif

    @if (Session::has('statusMessage'))
        <div class="alert alert-success small">
            {{ Session::get('statusMessage') }}
        </div>
    @endif

    @if($order["status"] == "confirmed")
        <p><b>@lang('public.order.confirmed')</b></p>

        <p>@lang('public.order.confirmed_description', ['order_number' => $order["number"], 'timeout' => 30])</p>

        <div class="alert alert-success my-3 d-inline-block">
            @lang('public.order.summary', $order)
        </div>
        <br />
        <a href="{{ route('public.payment.pay', ['order_number' => $order["number"]]) }}" class="btn btn-primary">@lang('public.payment.button_do')</a>
    @elseif($order["status"] == "canceled")

    @elseif($order["status"] == "done")
        <div class="alert alert-success my-3 d-inline-block">
            <b>@lang('public.order.done')</b>
        </div>

        <p>@lang('public.order.done_description', ['order_number' => $order["number"]])</p>

        <a href="{{ route('public.account.ordered') }}" class="btn btn-primary">@lang('public.order.list')</a>
    @endif

@endsection
