@extends('layouts.admin')

@section('title', __('users.users'))

@section('content')
    <div class="container">
        @include('admin.users.blocks.header.list')
        @include('admin.users.blocks.list.index')
    </div>
@endsection
