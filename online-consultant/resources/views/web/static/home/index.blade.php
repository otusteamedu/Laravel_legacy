@extends('web.layouts.index')

@section('title', 'Главная')

@section('content')
   <div class="page-content">
       <div class="container">
           <div class="row">
               <div class="col"><h1>{{ __('common.app_name') }}</h1></div>
               <div class="col">Form</div>
           </div>
       </div>
   </div>
@endsection
