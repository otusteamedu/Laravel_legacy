@extends('web.layouts.main')
@section('body_class', 'body__front')

@section('content')
    <div class="container text-center text-white">
        <h1 class="pt-5">Strava Clone</h1>
        <p>Feel free to sign up anytime!</p>
        <p>
            <a href="/user/register" class="btn btn-lg btn-primary my-2">Sign up</a>
        </p>
    </div>
@endsection
