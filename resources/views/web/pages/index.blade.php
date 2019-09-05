@extends('web.layouts.main')
@section('body_class', 'body__index')

@section('content')
    <div class="container text-center text-white">
        <h1 class="pt-5">Strava Clone</h1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet
            dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper
            suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in
            vulputate velit esse molestie consequat.</p>
        <p>Feel free to sign up anytime!</p>
        <p>
            <a href="/user/register" class="btn btn-lg btn-primary my-2">Sign up</a>
        </p>
    </div>
@endsection
