@php($pageTitle = 'nav.in_development')
@php($userAuthorized = true)
{{-- common page elements --}}
@extends('common.page-content')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.page-title', ['pageTitle' => 'messages.in_development.title'])
    <div class="row">
        <a href="/">@lang('messages.in_development.continue')</a>
    </div>
@endsection

