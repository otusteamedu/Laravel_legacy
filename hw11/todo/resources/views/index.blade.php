@extends('layouts.main')

@section('title', __('messages.title'))
@section('content')
   <div class="container">
       @php
           $breadcrumbs = [
               [
                   'url' => '/',
                   'title' => __('messages.home'),
               ],
           ];
       @endphp
       @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
   </div>
   @include('callback::index')
@endsection


