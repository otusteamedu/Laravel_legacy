@extends('cms.layout')
@section('title', __('cms.user.title.index'))
@section('h1', __('cms.user.title.index'))
@section('controls')
    <div class="p-2">
        <a class="btn btn-primary" href="{{ route('cms.users.create') }}" role="button">{{__('cms.user.actions.add')}}</a>
    </div>
@endsection
@section('content')
    <table class="table table-striped">
        @include('cms.user.blocks.list.header')
        <tbody>
        @each('cms.user.blocks.list.item', $users, 'user')
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
