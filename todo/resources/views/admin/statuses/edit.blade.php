@extends('layouts.admin')

@section('title', __('statuses.editStatus'))

@section('content')
    <div class="container">
        @include('admin.statuses.blocks.header.edit')
        @include('admin.statuses.blocks.form.edit')
    </div>
@endsection
