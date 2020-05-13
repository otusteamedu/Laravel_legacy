@php($pageTitle = 'nav.user_page')
@php($userAuthorized = true)
{{-- common page elements --}}
@extends('common.page-content')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.page-title', ['pageTitle' => 'messages.page_user.title'])
    <div class="row">
        <div class="col-sm-12 col-md-12">@lang('messages.page_user.info')</div>
    </div>
@endsection
