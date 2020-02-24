@extends('layouts.master')
@section('content')
    <div class="login-form">
        <form action="" method="post">
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            <div class="login-checkbox">
                <label>
                    <input type="checkbox" name="aggree">Agree the terms and policy
                </label>
            </div>
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="#">Sign In</a>
            </p>
        </div>
    </div>
@stop
