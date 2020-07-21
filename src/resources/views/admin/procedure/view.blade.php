@extends('admin.layouts.main')

@section('title', "#".$procedure->id." Procedure")

@section('content')

    @include('admin.blocks._header')

    @include('admin.procedure._detail')

@stop
