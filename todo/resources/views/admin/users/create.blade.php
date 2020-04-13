@extends('layouts.admin')

@section('title', __('users.create_user'))

@section('content')
    <div class="container">
        @include('admin.users.blocks.header.create')
        @include('admin.users.blocks.form.create')
    </div>
@endsection
