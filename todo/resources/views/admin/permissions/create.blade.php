@extends('layouts.admin')

@section('title', __('permissions.create_permission'))

@section('content')

    <div class="container">
        @include('admin.permissions.blocks.header.create')
        @include('admin.permissions.blocks.form.create')
    </div>
@endsection
