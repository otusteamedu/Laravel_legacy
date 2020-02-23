@extends('cms.layout')
@section('title', __('cms.comment.title.index'))
@section('h1', __('cms.comment.title.index'))
@section('controls', '')
@section('content')
    <table class="table table-striped">
        @include('cms.comment.blocks.list.header')
        <tbody>
        @each('cms.comment.blocks.list.item', $comments, 'comment')
        </tbody>
    </table>

    {{ $comments->links() }}
@endsection
