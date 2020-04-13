@extends('layouts.admin')

@section('title', __('permissions.editPermission'))

@section('content')

    <div class="container">
        @include('admin.permissions.blocks.header.edit')
        @include('admin.permissions.blocks.form.edit')
    </div>
@endsection
