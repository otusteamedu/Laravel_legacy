@extends('cms.layout')
@section('title', __('cms.post.title.index'))
@section('h1', __('cms.post.title.index'))
@section('controls')
    @can(\App\Policies\Abilities::CREATE, \App\Models\Post\Post::class)
        <div class="p-2">
            <a class="btn btn-primary" href="{{ route('cms.posts.create', ['locale' => $locale]) }}" role="button">{{__('cms.post.actions.add')}}</a>
        </div>
    @endcan
@endsection
@section('content')
    <table class="table table-striped">
        @include('cms.post.blocks.list.header')
        <tbody>
        @each('cms.post.blocks.list.item', $posts, 'post')
        </tbody>
    </table>
    {{ $posts->links() }}
@endsection
