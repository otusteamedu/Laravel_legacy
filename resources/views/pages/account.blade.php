@extends('layouts.layouts')
@section('title','Account')
@section('h1','Account')
@section('body-class','contact')
@section('content')
<!-- Contact Section -->
<section class="contact-section section-box">
    <div class="container">
        <div class="contact-content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="quote-form">
                        <form class="form-contact js-contact-form" method="POST" action="includes/contact-form.php">
                            <div class="form-input">
                                <input type="text" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="form-input">
                                <input type="email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" name="email" placeholder="Your Email">
                            </div>
                            <div class="form-input">
                                <input type="password" required name="password" placeholder="Account Password">
                            </div>
                            <div class="form-input">
                                <input type="text" required name="adress" placeholder="Address">
                            </div>
                            <div class="form-bottom">
                                <input type="submit" class="end-quote-1" name="quote" value="Save">
                                <span><i class="zmdi zmdi-arrow-right"></i></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Section -->
@endsection
