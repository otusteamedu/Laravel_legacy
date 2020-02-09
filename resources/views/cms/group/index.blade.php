@extends('cms.layout')
@section('title', __('cms.group.title.index'))
@section('h1', __('cms.group.title.index'))
@section('controls')
    <div class="p-2">
        <a class="btn btn-primary" href="{{ route('cms.groups.create') }}" role="button">{{__('cms.group.actions.add')}}</a>
    </div>
@endsection
@section('content')
    <table class="table table-striped">
        @include('cms.group.blocks.list.header')
        <tbody>
        @each('cms.group.blocks.list.item', $groups, 'group')
        </tbody>
    </table>

    {{ $groups->links() }}
@endsection
