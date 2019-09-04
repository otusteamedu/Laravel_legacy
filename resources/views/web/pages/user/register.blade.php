@extends('web.layouts.main')

@section('content')

    <div class="container text-center">
        <form class="form-signup">
            <h1 class="h3 mb-3 font-weight-normal">Sign up</h1>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
            <p class="mt-5 mb-3 text-muted">You agree to the Legal Terms and Privacy Statement by clicking the button
                above.</p>
        </form>
    </div>

@endsection
