@extends('portal.layout')
@section('title', __('messages.index'))
@section('content')
    @include('portal.blocks.posts.list')
@endsection