@php($pageTitle = 'nav.in_development')
@php($userAuthorized = true)
{{-- common page elements --}}
@extends('common.pageContent')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.pageTitle', ['pageTitle' => 'messages.in_development.title'])
    <div class="row">
        <a href="/">@lang('messages.in_development.continue')</a>
    </div>
@endsection

