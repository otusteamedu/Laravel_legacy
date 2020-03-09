@extends('layouts.app')
@section('breadcrumbs', '')
@section('h1')
    Авторизация
@stop

@section('content')
<div class="col-md-12 col-lg-6">
    @include('layouts.blocks.alerts.auth_form')
</div>
@endsection
