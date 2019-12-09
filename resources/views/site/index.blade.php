@extends('layouts.main')

@section('title', __('message.site.main.title'))

@section('content')
    <main role="main" class="inner cover">
        <h1 class="cover-heading">{{ __('message.site.main.header') }}</h1>
        <p class="lead">{{ __('message.site.main.text') }}</p>
        <p class="lead">
            <a href="{{ route('site.about') }}" class="btn btn-lg btn-secondary">{{ __('message.site.main.learn_more') }}</a>
        </p>
    </main>
@endsection