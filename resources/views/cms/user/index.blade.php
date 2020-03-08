@extends('cms.layout')
@section('title', __('cms.user.title.index'))
@section('h1', __('cms.user.title.index'))
@section('controls')
    @can(\App\Policies\Abilities::CREATE, \App\Models\User\User::class)
        <div class="p-2">
            <a class="btn btn-primary" href="{{ route('cms.users.create', ['locale' => $locale]) }}" role="button">{{__('cms.user.actions.add')}}</a>
        </div>
    @endcan
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
