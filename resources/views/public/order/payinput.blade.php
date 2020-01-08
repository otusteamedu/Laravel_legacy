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
    @lang('public.payment.payment_input_title')
@endsection

@section('pageHeader')
    @lang('public.payment.payment_input_title')
@endsection

@section('pageContentMain')
    <div class="bg-primary my-3 d-inline-block p-2 text-white">
        @lang('public.order.order_number', ['order_number' => $order['number']])
    </div>
    <br/>
    <p>@lang('public.payment.payment_id', ['payment_id' => $payment['payment_id']])</p>
    <p>@lang('public.payment.payment_description', ['total' => $payment['total']])</p>
    <hr />
    @if($payment["stage"] == \App\Models\Payment::STAGE_CREATED)
        <p><b>@lang('public.payment.card_data')</b></p>
        {{ Form::open(['url' => route('public.payment.save'), 'method' => 'post']) }}
        {{ Form::hidden('payment_id', $payment['payment_id']) }}
        <div class="card-data" style="width:420px;border:4px solid #000">
            <div class="container-fluid order-block i-iblock">
                <div class="row">
                    <div class="col-12 p-2">
                        {{ Form::label('card_number', __('public.payment.card_number')) }}<br/>
                        {{ Form::text('input[card_number]', $inputData['card_number'], ['id' => 'card_number', 'class' => 'form-control', 'role' => 'card_number']) }}
                        @error('card_number')
                        <div class="alert alert-danger px-2 py-0 my-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-2">
                        {{ Form::label('card_person', __('public.payment.card_person')) }}<br/>
                        {{ Form::text('input[card_person]', $inputData['card_person'], ['id' => 'card_person', 'class' => 'form-control']) }}
                        @error('card_person')
                        <div class="alert alert-danger px-2 py-0 my-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 p-2">
                        {{ Form::label('card_term', __('public.payment.card_term')) }}<br/>
                        {{ Form::text('input[card_term]', $inputData['card_term'], ['id' => 'card_term', 'class' => 'form-control', 'role' => 'card_term']) }}
                        @error('card_term')
                        <div class="alert alert-danger px-2 py-0 my-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4 p-2">
                        {{ Form::label('card_csv', __('public.payment.card_csv')) }}<br/>
                        {{ Form::text('input[card_csv]', $inputData['card_csv'], ['id' => 'card_csv', 'class' => 'form-control', 'role' => 'card_csv']) }}
                        @error('card_csv')
                        <div class="alert alert-danger px-2 py-0 my-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        {{ Form::submit(__('public.payment.button_send'), array('class' => 'btn btn-success')) }}
        {{ Form::close() }}
        <br /><br />
        <small class="text-secondary">
            Чтобы оплата прошла: <br/>
            - номер карты должен оканчиваться на четную цифру;<br/>
            - срок окончания действия карты должен быть больше текущей
        </small>
    @elseif($payment["stage"] == \App\Models\Payment::STAGE_CARD_INPUT)
        <div class="container-fluid order-ticket i-iblock">
            <div class="row align-items-start m-0">
                <div class="col-md-6 px-0">
                    <p><b>@lang('public.payment.card_data')</b></p>

                    <div class="card-data" style="width:420px;border:4px solid #000">
                        <div class="container-fluid order-block i-iblock">
                            <div class="row">
                                <div class="col-12 p-2">
                                    {{ Form::label('card_number', __('public.payment.card_number')) }}<br/>
                                    {{ Form::text('input[card_number]', $payment['payment_data']['card_number'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-2">
                                    {{ Form::label('card_person', __('public.payment.card_person')) }}<br/>
                                    {{ Form::text('input[card_person]', $payment['payment_data']['card_person'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 p-2">
                                    {{ Form::label('card_term', __('public.payment.card_term')) }}<br/>
                                    {{ Form::text('input[card_term]', $payment['payment_data']['card_term'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                                <div class="col-4 p-2">
                                    {{ Form::label('card_csv', __('public.payment.card_csv')) }}<br/>
                                    {{ Form::text('input[card_csv]', $payment['payment_data']['card_csv'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p><b>@lang('public.payment.status')</b></p>
                    <div class="p-5 bg-secondary text-center text-white" id="statusLoader">
                        <div class="spinner-grow my-3">
                        </div><br /><br />
                        <div id="statusMessage"><b>@lang('public.payment.wait_server')...</b></div>
                    </div>

                    <script type="text/javascript">
                        $(function() {
                            $.ajax({
                                url: "{{ route('public.payment.process', ['payment_id' => $payment['payment_id']]) }}",
                                method: "GET",
                                success: function(data) {
                                    var msgNode = $("#statusLoader").removeClass("bg-secondary");
                                    if(data.is_error)
                                        msgNode.addClass("bg-danger");
                                    else
                                        msgNode.addClass("bg-success");

                                    msgNode.html(data.message);
                                    setTimeout(function() {
                                        location.href = data.redirectTo;
                                    }, 3000);
                                },
                                error: function() {
                                    $("#statusLoader").removeClass("bg-secondary").addClass("bg-danger");
                                    $("#statusMessage").html("<b>@lang('errors.unknown')</b><br/><br/>@lang('public.payment.redirecting')");
                                    setTimeout(function() {
                                    //    location.href = "{{ route('public.payment.input', ['payment_id' => $payment['payment_id']]) }}";
                                    }, 3000);
                                },
                                dataType: 'json'
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    @elseif($payment["stage"] == \App\Models\Payment::STAGE_CARD_CHECKED)
        <div class="container-fluid order-block i-iblock">
            <div class="row">
                <div class="col-6 p-0">
                    <p><b>@lang('public.payment.check_data')</b></p>
                    {{ Form::open(['url' => route('public.payment.save'), 'method' => 'post']) }}
                    {{ Form::hidden('payment_id', $payment['payment_id']) }}
                    <div style="width:420px;">
                        <div class="container-fluid order-block i-iblock">
                            <div class="row">
                                <div class="col-8 py-2 px-0">
                                    {{ Form::label('check_code', __('public.payment.check_code')) }}
                                </div>
                                <div class="col-4 py-2 px-0">
                                    {{ Form::text('check_code', $inputData['check_code'], ['class' => 'form-control', 'id' => 'check_code']) }}
                                </div>
                            </div>
                        </div>
                        @error('check_code')
                            <div class="alert alert-danger px-2 py-0 my-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                    {{ Form::submit(__('public.payment.button_send'), array('class' => 'btn btn-success')) }}
                    {{ Form::close() }}
                    <br /><br />
                    <small class="text-secondary">
                        Чтобы оплата прошла: <br/>
                        - проверочный код: 123456
                    </small>
                </div>
                <div class="col-6 p-0">
                    <p><b>@lang('public.payment.card_data')</b></p>
                    <div class="card-data" style="width:420px;border:4px solid #000">
                        <div class="container-fluid order-block i-iblock">
                            <div class="row">
                                <div class="col-12 p-2">
                                    {{ Form::label('card_number', __('public.payment.card_number')) }}<br/>
                                    {{ Form::text('input[card_number]', $payment['payment_data']['card_number'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-2">
                                    {{ Form::label('card_person', __('public.payment.card_person')) }}<br/>
                                    {{ Form::text('input[card_person]', $payment['payment_data']['card_person'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 p-2">
                                    {{ Form::label('card_term', __('public.payment.card_term')) }}<br/>
                                    {{ Form::text('input[card_term]', $payment['payment_data']['card_term'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                                <div class="col-4 p-2">
                                    {{ Form::label('card_csv', __('public.payment.card_csv')) }}<br/>
                                    {{ Form::text('input[card_csv]', $payment['payment_data']['card_csv'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($payment["stage"] == \App\Models\Payment::STAGE_CODE_INPUT)
        <div class="container-fluid order-block i-iblock">
            <div class="row">
                <div class="col-6 p-0">
                    <p><b>@lang('public.payment.check_data')</b></p>
                    <div style="width:420px;">
                        <div class="container-fluid order-block i-iblock">
                            <div class="row">
                                <div class="col-8 py-2 px-0">
                                    {{ Form::label('check_code', __('public.payment.check_code')) }}
                                </div>
                                <div class="col-4 py-2 px-0">
                                    {{ Form::text('check_code', $inputData['check_code'], ['class' => 'form-control', 'id' => 'check_code', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <p><b>@lang('public.payment.card_data')</b></p>
                    <div class="card-data" style="width:420px;border:4px solid #000">
                        <div class="container-fluid order-block i-iblock">
                            <div class="row">
                                <div class="col-12 p-2">
                                    {{ Form::label('card_number', __('public.payment.card_number')) }}<br/>
                                    {{ Form::text('input[card_number]', $payment['payment_data']['card_number'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-2">
                                    {{ Form::label('card_person', __('public.payment.card_person')) }}<br/>
                                    {{ Form::text('input[card_person]', $payment['payment_data']['card_person'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 p-2">
                                    {{ Form::label('card_term', __('public.payment.card_term')) }}<br/>
                                    {{ Form::text('input[card_term]', $payment['payment_data']['card_term'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                                <div class="col-4 p-2">
                                    {{ Form::label('card_csv', __('public.payment.card_csv')) }}<br/>
                                    {{ Form::text('input[card_csv]', $payment['payment_data']['card_csv'], ['class' => 'form-control', 'disabled' => 'disabled']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 p-0">
                    <p><b>@lang('public.payment.status')</b></p>
                    <div class="p-5 bg-secondary text-center text-white" id="statusLoader">
                        <div class="spinner-grow my-3">
                        </div><br /><br />
                        <div id="statusMessage"><b>@lang('public.payment.wait_server')...</b></div>
                    </div>
                    <script type="text/javascript">
                        $(function() {
                            $.ajax({
                                url: "{{ route('public.payment.process', ['payment_id' => $payment['payment_id']]) }}",
                                method: "GET",
                                success: function(data) {
                                    var msgNode = $("#statusLoader").removeClass("bg-secondary");
                                    if(data.is_error)
                                        msgNode.addClass("bg-danger");
                                    else
                                        msgNode.addClass("bg-success");

                                    msgNode.html(data.message);
                                    setTimeout(function() {
                                        location.href = data.redirectTo;
                                    }, 3000);
                                },
                                error: function() {
                                    $("#statusLoader").removeClass("bg-secondary").addClass("bg-danger");
                                    $("#statusMessage").html("<b>@lang('errors.unknown')</b><br/><br/>@lang('public.payment.redirecting')");
                                    setTimeout(function() {
                                        //    location.href = "{{ route('public.payment.input', ['payment_id' => $payment['payment_id']]) }}";
                                    }, 3000);
                                },
                                dataType: 'json'
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    @endif

@endsection
