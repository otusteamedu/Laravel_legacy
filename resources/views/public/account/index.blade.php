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
            <a href="{{ route('public.account.order') }}">
                @lang('public.account.order')
            </a>
        </li>
        <li>
            <a href="{{ route('public.account.ordered') }}">
                @lang('public.account.ordered')
            </a>
        </li>
    </ul>
    <a href="#" class="btn btn-primary shadow">@lang('public.logout')</a>
@endsection
