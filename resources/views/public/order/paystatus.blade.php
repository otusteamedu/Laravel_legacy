@extends('public.order.layout')

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home'),
        ], [
            'url' => \route('public.order.confirmed'),
            'title' => __('public.menu.payment'),
        ]
    ];

@endphp

@section('pageTitle')
    @lang('public.payment.payment_status_title')
@endsection

@section('pageHeader')
    @lang('public.payment.payment_status_title')
@endsection

@section('pageContentMain')
    <div class="bg-primary my-3 d-inline-block p-2 text-white">
        @lang('public.order.order_number', ['order_number' => $order['number']])
    </div>
    <br/>
    <p>@lang('public.payment.payment_id', ['payment_id' => $payment['payment_id']])</p>

    @if($payment['stage'] == \App\Models\Payment::STAGE_DONE)
        <div class="bg-success my-3 d-inline-block p-2 text-white">
            @lang('public.payment.stage_done', ['total' => $payment['total']])
        </div><br />
        <a href="{{ route('public.order.confirmed', ['order_number' => $order['number']]) }}" class="btn btn-success">
            @lang('public.go_back')</a>
    @else
        <div class="bg-danger my-3 d-inline-block p-2 text-white">
            <b>@lang('public.payment.is_error'):</b><br />
            {{ $payment['message'] }}
        </div><br />
        <a href="{{ route('public.payment.pay', ['order_number' => $order['number']]) }}" class="btn btn-primary">
            @lang('public.payment.try_again')</a>
    @endif
@endsection

