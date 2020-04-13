@extends('layouts.admin')

@section('title', __('statuses.statuses'))

@section('content')
    <div class="container">
        @include('admin.statuses.blocks.header.list')
        @include('admin.statuses.blocks.list.index')
    </div>
@endsection
