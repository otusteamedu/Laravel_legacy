@extends('layouts.admin')

@section('title', __('roles.roles'))

@section('content')
    <div class="container">
        @include('admin.roles.blocks.header.list')
        @include('admin.roles.blocks.list.index')
    </div>
@endsection
