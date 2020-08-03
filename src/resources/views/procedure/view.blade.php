@extends('admin.layouts.main')

@section('title', "#".$procedure->id." ".$procedure->name)

@section('content')

    @include('blocks._header')

    @include('procedure._detail')

@stop
