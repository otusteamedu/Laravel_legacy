@php($pageTitle = 'nav.about_page')
@php($userAuthorized = true)
{{-- common page elements --}}
@extends('common.page-content')
{{-- section 'page-content' --}}
@section('page-content')
    @include('blocks.page-title', ['pageTitle' => 'messages.page_about.title'])
    <div class="row">
        <div class="col-sm-12 col-md-12">@lang('messages.page_about.info')</div>
    </div>
@endsection
