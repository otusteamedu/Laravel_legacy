@extends('layouts.admin')

@section('title', __('users.editUser'))

@section('content')
    <div class="container">
        @include('admin.users.blocks.header.edit')
        @include('admin.users.blocks.form.edit')
    </div>
@endsection
