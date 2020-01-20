@extends('layouts.layouts')
@section('title','Shop Cart')
@section('h1','Shop Cart')
@section('body-class','contact')
@section('content')
<!-- Shop Cart Section -->
<section class="shop-cart-section section-box">
    <div class="woocommerce">
        <div class="container">
            <div class="entry-content">
                <form class="woocommerce-cart-form" method="POST">
                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                        <thead>
                        <tr>
                            <th class="product-remove"></th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="woocommerce-cart-form__cart-item cart_item">
                            <td class="product-remove">
                                <a href="#" class="remove"><i class="zmdi zmdi-close"></i></a>
                            </td>
                            <td class="product-name" data-title="Product">
                                <a href="#"><img src="images/checkout-1.jpg" alt="product"></a>
                                <a href="#">Low Table/Stool</a>
                            </td>
                            <td class="product-price" data-title="Price">
											<span class="woocommerce-Price-amount amount">
												<span class="woocommerce-Price-currencySymbol">$</span>
												29
											</span>
                            </td>
                            <td class="product-quantity" data-title="Quantity">
                                <div class="quantity">
                                    <span class="modify-qty minus" onclick="Decrease()">-</span>
                                    <input type="number" name="quantity" id="quantity" value="4" min="1" class="input-text qty text">
                                    <span class="modify-qty plus" onclick="Increase()">+</span>
                                </div>
                            </td>
                            <td class="product-subtotal" data-title="Total">
											<span class="woocommerce-Price-amount amount">
												<span class="woocommerce-Price-currencySymbol">$</span>
												116
											</span>
                            </td>
                        </tr>
                        <tr class="woocommerce-cart-form__cart-item cart_item">
                            <td class="product-remove">
                                <a href="#" class="remove"><i class="zmdi zmdi-close"></i></a>
                            </td>
                            <td class="product-name" data-title="Product">
                                <a href="#"><img src="images/checkout-2.jpg" alt="product"></a>
                                <a href="#">Set of 3 Porcelain</a>
                            </td>
                            <td class="product-price" data-title="Price">
											<span class="woocommerce-Price-amount amount">
												<span class="woocommerce-Price-currencySymbol">$</span>
												124
											</span>
                            </td>
                            <td class="product-quantity" data-title="Quantity">
                                <div class="quantity">
                                    <span class="modify-qty minus" onclick="Decrease2()">-</span>
                                    <input type="number" name="quantity" id="quantity_02" value="2" min="1" class="input-text qty text">
                                    <span class="modify-qty plus" onclick="Increase2()">+</span>
                                </div>
                            </td>
                            <td class="product-subtotal" data-title="Total">
											<span class="woocommerce-Price-amount amount">
												<span class="woocommerce-Price-currencySymbol">$</span>
												248
											</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="actions">
                                <div class="coupon">
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code">
                                    <div>
                                        <input type="submit" class="button au-btn btn-small" name="apply_coupon" value="Apply Coupon">
                                        <span><i class="zmdi zmdi-arrow-right"></i></span>
                                    </div>
                                </div>
                                <div class="action-btn">
                                    <input type="submit" class="button au-btn btn-small" name="update_cart" value="Update Cart">
                                    <span><i class="zmdi zmdi-arrow-right"></i></span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                <div class="cart-collaterals">
                    <div class="cart_totals">
                        <h2>Cart totals</h2>
                        <table class="shop_table shop_table_responsive">
                            <tbody>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td data-title="Subtotal">
												<span class="woocommerce-Price-amount amount">
													<span class="woocommerce-Price-currencySymbol">$</span>
													364
												</span>
                                </td>
                            </tr>
                            <tr class="shipping">
                                <th>Shipping</th>
                                <td>
                                    <span class="shipping-calculator-button">Calculate Shipping</span>
                                    <section class="shipping-calculator-form">
                                        <p class=" form-row-wide" id="calc_shipping_country_field">
                                            <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select select2-hidden-accessible" rel="calc_shipping_state" tabindex="-1" aria-hidden="true">
                                                <option value="VN">VietNam</option>
                                                <option value="JP">Japan</option>
                                                <option value="ZM">Korea</option>
                                            </select>
                                            <span class="select-btn">
															<i class="zmdi zmdi-caret-down"></i>
														</span>
                                        </p>
                                        <p class="form-row-wide" id="calc_shipping_state_field">
                                            <input type="text" class="hidden" name="calc_shipping_state" id="calc_shipping_state" value="" placeholder="Town / City">
                                        </p>
                                        <p class="form-row-wide" id="calc_shipping_postcode_field">
                                            <input type="text" class="input-text" value="" placeholder="Postcode / ZIP" name="calc_shipping_postcode" id="calc_shipping_postcode">
                                        </p>
                                        <p>
                                            <button type="submit" name="calc_shipping" value="1" class="button au-btn btn-small">Update Totals<i class="zmdi zmdi-arrow-right"></i></button>
                                        </p>
                                    </section>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td data-title="Total">
												<span class="woocommerce-Price-amount amount">
													<span class="woocommerce-Price-currencySymbol">$</span>
													364
												</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="wc-proceed-to-checkout">
                            <a href="checkout" class="checkout-button button wc-forward au-btn btn-small ">Proceed to Checkout<i class="zmdi zmdi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Cart Section -->
@endsection
