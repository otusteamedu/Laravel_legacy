@extends('public.account.layout')

@section('pageTitle')
    @lang('public.account.index')
@endsection

@section('pageHeader')
    @lang('public.account.index')
@endsection

@section('pageContentMain')
    <ul>
        <li>
            <a href="{{ route('public.account.profile') }}">
                @lang('public.account.profile')
            </a>
        </li>
        <li>
            <a href="{{ route('public.account.ordered') }}">
                @lang('public.account.ordered')
            </a>
        </li>
    </ul>
    {{ Form::open(['url' => route('logout'), 'method' => 'post']) }}
    {{ Form::submit(__('public.logout'), array('class' => 'btn btn-primary shadow')) }}
    {{ Form::close() }}
@endsection
