@extends('layout')

@section('main')
    <section class="section-registration">
    <div class="container">
    <div class="row">
        <div class="col-12 order-md-1">
            <h4 class="mb-3">Регистрация</h4>
            <form class="needs-validation" novalidate="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" required="">
                        <div class="invalid-feedback" style="width: 100%;">
                            Your username is required.
                        </div>

                </div>

                <div class="mb-3">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                <div class="row">
                <button class="btn btn-secondary btn-lg btn-block" type="submit">Зарегистрироваться</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</section>
@endsection
