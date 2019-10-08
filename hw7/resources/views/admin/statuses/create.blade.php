@extends('layouts.admin')

@section('title', __('statuses.create_status'))

@section('content')
    <div class="container">
        @include('admin.statuses.blocks.header.create')
        @include('admin.statuses.blocks.form.create')
    </div>
@endsection
