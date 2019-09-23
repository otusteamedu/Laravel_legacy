@extends('layouts.app')

@section('top_nav')
    @include('navigation.top_menu')
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="col-6 form-auth">
                    <h2>Registration</h2>
                    <form>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-secondary float-right">Register</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection


