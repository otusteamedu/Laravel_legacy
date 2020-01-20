@extends('layouts.layouts')
@section('title','Checkout')
@section('h1','Checkout')
@section('body-class','contact')
@section('content')
<!-- Check Out Section -->
<section class="checkout-section section-box">
    <div class="woocommerce">
        <div class="container">
            <div class="entry-content">
                <div class="woocommerce-info">
                    Returning customer?
                    <a class="showlogin">Click here to login</a>
                </div>
                <form class="woocommerce-form woocommerce-form-login" method="POST">
                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a  new customer, please proceed to the Billing & Shipping section.</p>
                    <p class="form-row-first">
                        <input type="text" class="input-text" name="username" id="username" placeholder="Username or email*">
                    </p>
                    <p class="form-row-last">
                        <input class="input-text" type="password" name="password" id="password" placeholder="Password*">
                    </p>
                    <p class="form-button">
                        <label>
                            <input type="submit" class="woocommerce-Button au-btn btn-small" name="login" value="Login">
                            <span class="arrow-right"><i class="zmdi zmdi-arrow-right"></i></span>
                        </label>
                        <label class="woocommerce-form__label">
                            <input class="woocommerce-form__input" name="rememberme" type="checkbox" id="rememberme" value="forever">
                            <span>Create an account?</span>
                        </label>
                    </p>
                    <p class="woocommerce-LostPassword">
                        <a href="lost-password.html">Lost your password?</a>
                    </p>
                </form>
                <div class="woocommerce-info">
                    Have a coupon?
                    <a class="showcoupon">Click here to enter your code</a>
                </div>
                <form class="checkout_coupon" method="post">
                    <p class="form-row-first">
                        <input type="text" name="coupon_code" class="input-text" placeholder="Coupon code" id="coupon_code" value="">
                    </p>
                    <p class="form-row-last">
                        <input type="submit" class="button au-btn btn-small" name="apply_coupon" value="Apply Coupon">
                        <span class="arrow-right"><i class="zmdi zmdi-arrow-right"></i></span>
                    </p>
                </form>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <form class="checkout woocommerce-checkout" method="POST">
                            <div class="woocommerce-billing-fields">
                                <h2>Billing details</h2>
                                <div class="woocommerce-billing-fields__field-wrapper">
                                    <p class="form-row-first">
                                        <input type="text" class="input-text " id="billing_first_name" placeholder="First Name *">
                                    </p>
                                    <p class="form-row-last">
                                        <input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="Last Name *">
                                    </p>
                                    <p class="form-row-wide">
                                        <input type="text" class="input-text " name="billing_company" id="billing_company" placeholder="Company Name">
                                    </p>
                                    <p class="form-row-wide">
                                        <label for="billing_country">Country <abbr class="required" title="required">*</abbr></label>
                                        <select id="billing_country" class="country_select" name="billing_country">
                                            <option value="VN">VietNam</option>
                                            <option value="CL">Chile</option>
                                            <option value="JP">Japan</option>
                                            <option value="IT">Italy</option>
                                        </select>
                                        <span class="select-btn"><i class="zmdi zmdi-caret-down"></i></span>
                                    </p>
                                    <p class="form-row-wide">
                                        <label for="billing_address_1">Address <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" class="input-text " name="billing_address_1" id="billing_address_1" placeholder="Street address">
                                    </p>
                                    <p class="form-row-wide">
                                        <input type="text" class="input-text " name="billing_address_2" id="billing_address_2" placeholder="Apartment, suite, unit etc. (optional)">
                                    </p>
                                    <p class="form-row-wide">
                                        <input type="text" class="input-text " name="billing_city" id="billing_city" placeholder="Town/City *">
                                    </p>
                                    <p class="form-row-wide">
                                        <input type="text" class="input-text " placeholder="County *" name="billing_state" id="billing_state">
                                    </p>
                                    <p class="form-row-wide form-row-wide-1">
                                        <select id="billing_postcode" class="postcode_select" name="billing_postcode">
                                            <option value="default" selected="selected">Postcode / Zip *</option>
                                            <option value="154000">154000</option>
                                            <option value="154100">154100</option>
                                            <option value="118500">118500</option>
                                            <option value="123000">123000</option>
                                        </select>
                                        <span class="select-btn"><i class="zmdi zmdi-caret-down"></i></span>
                                    </p>
                                    <p class="form-row-first">
                                        <input type="tel" class="input-text " name="billing_phone" id="billing_phone" placeholder="Phone *">
                                    </p>
                                    <p class="form-row-last">
                                        <input type="email" class="input-text " name="billing_email" id="billing_email" placeholder="Email Address *">
                                    </p>
                                </div>
                            </div>
                            <div class="woocommerce-account-fields">
                                <p class="woocommerce-validated">
                                    <label class="woocommerce-form__label-for-checkbox">
                                        <input class="woocommerce-form__input-checkbox" id="createaccount" type="checkbox" name="createaccount">
                                        <span>Create an account?</span>
                                    </label>
                                </p>
                                <div class="create-account">
                                    <p id="account_password_field">
                                        <label for="account_password" class="">Create account password <abbr class="required" title="required">*</abbr></label>
                                        <input type="password" class="input-text " name="account_password" id="account_password" placeholder="Password">
                                    </p>
                                </div>
                            </div>
                            <div class="woocommerce-additional-fields">
                                <h2>Additional information</h2>
                                <div class="woocommerce-additional-fields__field-wrapper">
                                    <p class="notes" id="order_comments_field">
                                        <label for="order_comments" class="">Order notes</label>
                                        <textarea name="order_comments" class="input-text " id="order_comments" placeholder="Note about your order, eg. special notes fordelivery."></textarea>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="woocommerce-checkout-review-order">
                            <h2 id="order_review_heading">Your order</h2>
                            <table class="shop_table">
                                <tbody>
                                <tr class="cart_item">
                                    <td class="product-name">
                                        <img src="images/checkout-1.jpg" alt="product">
                                        <div class="review-wrap">
                                            <span class="cart_item_title">Low Table/Stool</span>
                                            <span class="product-quantity">x4</span>
                                        </div>
                                    </td>
                                    <td class="product-total">
													<span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">$</span>
                                                        29
                                                    </span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="product-name">
                                        <img src="images/checkout-2.jpg" alt="product">
                                        <div class="review-wrap">
                                            <span class="cart_item_title">Set of 3 Porcelain</span>
                                            <span class="product-quantity">x2</span>
                                        </div>
                                    </td>
                                    <td class="product-total">
													<span class="woocommerce-Price-amount amount">
                                                        <span class="woocommerce-Price-currencySymbol">$</span>
                                                        124
                                                    </span>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>
                                        <ul>
                                            <li class="cart-subtotal">
                                                <span class="review-total-title">Subtotal</span>
                                                <p>
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>
																	364
																</span>
                                                </p>
                                            </li>
                                            <li class="shipping">
                                                <span class="review-total-title">Shipping</span>
                                                <p>there are no shitdping methods available. please double check your address, or contact us if you need any help.</p>
                                            </li>
                                            <li class="order-total">
                                                <span class="review-total-title">Total</span>
                                                <p>
																<span class="woocommerce-Price-amount amount">
																	<span class="woocommerce-Price-currencySymbol">$</span>
																	364
																</span>
                                                </p>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <div class="woocommerce-checkout-payment">
                                <ul class="payment_methods">
                                    <li class="wc_payment_method">
                                        <input type="radio" id="payment_method_bacs" class="input-radio" name="payment_method" checked="checked" value="bacs">
                                        <label for="payment_method_bacs">Direct bank transfer</label>
                                        <div class="payment_box payment_method_bacs">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </li>
                                    <li class="wc_payment_method">
                                        <input type="radio" name="payment_method" id="payment_method_cheque" class="input-radio" value="cheque">
                                        <label for="payment_method_cheque">Check payments</label>
                                        <div class="payment_box payment_method_cheque">
                                            <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                        </div>
                                    </li>
                                    <li class="wc_payment_method">
                                        <input type="radio" name="payment_method" id="payment_method_cod" class="input-radio" value="cod">
                                        <label for="payment_method_cod">Cash on delivery</label>
                                        <div class="payment_box payment_method_cod">
                                            <p>Pay with cash upon delivery.</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="place-order">
                                    <input type="submit" class="button alt au-btn btn-small" name="woocommerce_checkout_place_order" id="place_order" value="Place Order">
                                    <span><i class="zmdi zmdi-arrow-right"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Check Out Section -->
@endsection
