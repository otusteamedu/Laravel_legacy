@extends('layouts.admin')

@section('title', __('roles.create_role'))

@section('content')
    <div class="container">
        @include('admin.roles.blocks.header.create')
        @include('admin.roles.blocks.form.create')
    </div>
@endsection
