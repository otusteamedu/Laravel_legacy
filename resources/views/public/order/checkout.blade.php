@extends('public.movies.layout')

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home'),
        ], [
            'url' => \route('public.order.checkout'),
            'title' => __('public.menu.checkout'),
        ]
    ];
@endphp

@section('pageTitle')
    Бронирование мест. Контактная информация
@endsection

@section('pageHeader')
    Бронирование мест
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
    <div class="container-fluid order-block i-iblock">
        <div class="row">
            <div class="col-md-7">
                <h5><b>Ваши билеты</b></h5>
                @if(count($items) > 0)
                <table class="table-sm table-bordered table-striped" width="100%">
                    <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>
                            {{ $item['name'] }}
                            @if(!$item['available'])
                                <br/><div class="alert alert-danger px-1 py-0 d-inline-block my-1">@lang('public.order.not_available')</div>
                            @endif
                        </td>
                        <td width="100" class="text-center"><b>{{ $item['price'] }}&nbsp;руб.</b></td>
                        <td width="100" class="text-center">
                            <a href="{{ route('public.order.removeitem', ['item_id' => $item['id']]) }}"
                               onclick="var o=document.getElementById('deleteModal').getElementsByTagName('form')[0];o.action=this.href;return false;"
                               class="i-icon i-delete text-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fas fa-trash"></i>
                                <span>@lang('public.order.delete')</span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table><br />
                <p><b>@lang('public.order.summary', $summary)</b></p>
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        {{ Form::open(['url' => route('public.order.removeitem'), 'method' => 'delete', 'class' => 'modal-content']) }}
                        <div class="modal-header">
                            <h5 class="modal-title">@lang('public.order.delete_confirm')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.close')</button>
                            <!--button type="button" class="btn btn-primary">Save changes</button-->
                            {{ Form::submit(__('public.order.delete'), array('class' => 'btn btn-danger')) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
                @else
                    <div class="list-empty alert alert-danger">
                        @lang('public.order.empty')
                    </div>
                @endif
            </div>
            <div class="col-md-5">
                @if(count($items) > 0)
                <h5><b>Контактные данные</b></h5>
                {{ Form::open(['url' => route('public.order.confirm'), 'method' => 'post']) }}
                    <div class="form-group row align-items-center">
                        <div class="col-sm-12 px-0">
                            {{ Form::label('name', __('public.order.name')) }} <span class="i-req">*</span><br/>
                            {{ Form::text('contact[name]', $contactData['name'], ['class' => 'form-control']) }}
                            @error('name')
                            <div class="alert alert-danger px-2 py-0 my-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-12 px-0">
                            {{ Form::label('premiere', __('public.order.phone')) }} <span class="i-req">*</span><br/>
                            {{ Form::text('contact[phone]', $contactData['phone'], ['class' => 'form-control input-phone', 'role' => 'phone']) }}
                            @error('phone')
                            <div class="alert alert-danger px-2 py-0 my-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-12 px-0">
                            {{ Form::label('slogan', __('public.order.email')) }} <span class="i-req">*</span><br/>
                            {{ Form::text('contact[email]', $contactData['email'], ['class' => 'form-control']) }}
                            @error('email')
                            <div class="alert alert-danger px-2 py-0 my-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <div class="col-5 px-0">
                        {{ Form::submit(__('public.order.order_confirm'), array('class' => 'btn btn-success')) }}
                        </div>
                        <div class="col-7 px-0 small">
                            <span class="i-req">*</span> &mdash; @lang('public.fieldsrequired')
                        </div>
                    </div>
                {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
@endsection
