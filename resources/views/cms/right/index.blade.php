@extends('cms.layout')
@section('title', __('cms.right.title.index'))
@section('h1', __('cms.right.title.index'))
@section('controls', '')
@section('content')
    <table class="table table-striped">
        @include('cms.right.blocks.list.header')
        <tbody>
        @each('cms.right.blocks.list.item', $rights, 'right')
        </tbody>
    </table>

    {{ $rights->links() }}
@endsection
