@extends('phpInfo.layout')

@section('favicon')
    {{ Html::favicon( '/images/favicon.png' ) }}
@endsection

@section('title', __('messages.userPage'))

@section('style')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endsection

@section('content')
{{ phpinfo() }}
@endsection