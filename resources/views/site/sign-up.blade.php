@php($pageTitle = 'nav.user_reg')
@php($userAuthorized = false)
{{-- common page elements --}}
@extends('common.page-content')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.page-title', ['pageTitle' => 'messages.page_reg.title'])
    <div class="form-login">
        @include('blocks.forms.login-form')
    </div>
@endsection
