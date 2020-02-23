@extends('cms.layout')
@section('title', __('cms.page.title.index'))
@section('h1', __('cms.page.title.index'))
@section('controls')
    <div class="p-2">
        <a class="btn btn-primary" href="{{ route('cms.pages.create') }}" role="button">{{__('cms.page.actions.add')}}</a>
    </div>
@endsection
@section('content')
    <table class="table table-striped">
        @include('cms.page.blocks.list.header')
        <tbody>
        @each('cms.page.blocks.list.item', $pages, 'page')
        </tbody>
    </table>

    {{ $pages->links() }}
@endsection
