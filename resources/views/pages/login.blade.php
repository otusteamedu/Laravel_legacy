@extends('layouts.layouts')
@section('h1','Sign in')
@section('title','Sign in')
@section('content')
<!-- My Account Section -->
<section class="my-account-section section-box">
    <div class="woocommerce">
        <div class="container">
            <div class="content-area">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="entry-content">
                            <h2 class="special-heading">Login account</h2>
                            <form class="woocommerce-form-login js-contact-form" action="includes/contact-form.php" method="POST">
                                <p class="woocommerce-form-row">
                                    <input type="text" class="woocommerce-Input input-text" name="username" id="username" value="" placeholder="Username or email address *">
                                </p>
                                <p class="woocommerce-form-row">
                                    <input class="woocommerce-Input input-text" type="password" name="password" id="password" placeholder="Password *">
                                </p>
                                <p class="form-button">
                                    <label>
                                        <input type="submit" class="woocommerce-Button au-btn btn-small" name="login" value="Login">
                                        <span class="arrow-right"><i class="zmdi zmdi-arrow-right"></i></span>
                                    </label>
                                    <label class="woocommerce-form__label">
                                        <input class="woocommerce-form__input" name="rememberme" type="checkbox" id="rememberme" value="forever">
                                        <span>Remember me</span>
                                    </label>
                                </p>
                                <p class="woocommerce-LostPassword">
                                    <a href="lost-password.html">Lost your password?</a>
                                </p>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="novas-form-signup">
                            <h2 class="special-heading">Register</h2>
                            <form class="woocommerce-form-register js-contact-form" action="includes/contact-form.php" method="post">
                                <p class="woocommerce-form-row">
                                    <input type="text" class="woocommerce-Input input-text" name="register_username" id="register_username" value="" placeholder="Email address *">
                                </p>
                                <p class="woocommerce-form-row">
                                    <input class="woocommerce-Input input-text" type="password" name="register_password" id="register_password" placeholder="Password *">
                                </p>
                                <p class="form-button">
                                    <input type="submit" class="woocommerce-Button au-btn btn-small" name="register" value="Register">
                                    <span class="arrow-right"><i class="zmdi zmdi-arrow-right"></i></span>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="novas-login-recommend">
                    <h2 class="special-heading">Recommended</h2>
                    <div class="socials-logins">
                        <a href="#" class="button-social-login login-facebook">
                            Facebook
                            <i class="zmdi zmdi-facebook-box"></i>
                        </a>
                        <a href="#" class="button-social-login login-google">
                            Google +
                            <i class="zmdi zmdi-google-plus-box"></i>
                        </a>
                        <a href="#" class="button-social-login login-instagram">
                            Instagram
                            <i class="zmdi zmdi-instagram"></i>
                        </a>
                        <a href="#" class="button-social-login login-twitter">
                            Twitter
                            <i class="zmdi zmdi-twitter-box"></i>
                        </a>
                    </div>
                    <p>Connect with Social Networks</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End My Account Section -->
@endsection
