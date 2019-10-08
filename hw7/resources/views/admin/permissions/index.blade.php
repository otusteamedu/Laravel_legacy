@extends('layouts.admin')

@section('title', __('permissions.permissions'))

@section('content')
    <div class="container">
        @include('admin.permissions.blocks.header.list')
        @include('admin.permissions.blocks.list.index')
    </div>
@endsection
