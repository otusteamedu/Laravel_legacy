@extends('web.layouts.main')
@section('body_class', 'body__user__register')

@section('content')

    <div class="container text-center">
        <form class="form-signup">
            <h1 class="h3 mb-3 font-weight-normal">Sign up</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <p class="mt-1 mb-4 text-muted">We will send your password and further details to this Email address.</p>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
            <p class="mt-2 mb-4 text-muted">You agree to the Legal Terms and Privacy Statement by clicking the button
                above.</p>
        </form>
    </div>

@endsection
