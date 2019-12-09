@php
/**
* @var $user \App\Models\User
*/
@endphp

@extends('layouts.main')

@section('title', __('message.user.user_page.title'))

@section('content')
    <main>
        <div class="container">
            <div class="row pt-5">
                <div class="col text-center">
                    <h2>{{ __('message.user.user_page.title') }}</h2>
                    <div class="card">
                        <img src="#" class="card-img-top" alt="Place for photo">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">Some information about user</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ __('message.user.user_page.email') }}: {{ $user->email }}</li>
                            <li class="list-group-item">{{ __('message.user.user_page.created_at') }}: {{ $user->created_at }}</li>
                            <li class="list-group-item">{{ __('message.user.user_page.updated_at') }}: {{ $user->updated_at }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection