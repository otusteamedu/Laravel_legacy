@extends('admin.layouts.main')

@section('title', "#".$business->id." Business")

@section('content')

    @include('admin.blocks._header')

    @include('admin.business._detail')

@stop
