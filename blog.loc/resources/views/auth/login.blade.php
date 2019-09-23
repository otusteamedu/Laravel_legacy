@extends('layouts.app')

@section('top_nav')
    @include('navigation.top_menu')
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="col-6 form-auth">
                    <h2>Login</h2>
                    <form>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>

                        <button type="submit" class="btn btn-secondary float-right">Login</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection


