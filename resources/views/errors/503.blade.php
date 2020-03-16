@extends('errors::minimal')

@section('title', __('Service Down'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Service Down'))
