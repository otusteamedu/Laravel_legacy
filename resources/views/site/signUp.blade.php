@php($pageTitle = 'nav.user_reg')
@php($userAuthorized = false)
{{-- common page elements --}}
@extends('common.pageContent')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.pageTitle', ['pageTitle' => 'messages.page_reg.title'])
    <div class="form-login">
        @include('blocks.forms.loginForm')
    </div>
@endsection
