@extends('layouts.user')

@section('title', 'Admin')

@section('content')
    <div class="col-6-md"><passport-clients></passport-clients></div>
    <div class="col-6-md"><passport-authorized-clients></passport-authorized-clients></div>
    <div class="col-6-md"><passport-personal-access-tokens></passport-personal-access-tokens></div>
@endsection

@section('scripts')
    @include('sections.users.scripts')
@endsection