@extends('layouts.admin')

@section('title', __('roles.editRole'))

@section('content')
    <div class="container">
        @include('admin.roles.blocks.header.edit')
        @include('admin.roles.blocks.form.edit')
    </div>
@endsection
