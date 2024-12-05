@extends('layouts.layouts')
@section('title','Homepage')
@section('h1','Shop')
@section('body-class','shop-full-width')
@section('content')
<!-- Shop Section -->
<section class="featured-hp-1 featured-hp-4 shop-full-page">
    <div class="container">
        <div class="featured-content woocommerce">
            <div class="content-area">
                <div class="storefront-sorting">
                    <p class="woocommerce-result-count">Showing 1 – 12 of 35 results</p>
                    <form class="woocommerce-ordering" method="get">
                        <select name="orderby" class="orderby">
                            <option value="popularity" selected="selected">Sort by popularity</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="date">Sort by newness</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                        <span><i class="zmdi zmdi-chevron-down"></i></span>
                    </form>
                </div>
                <div class="row">
                    <!-- Product 1 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img class="image-cover" src="images/hp-1-featured-1.jpg" alt="product">
                                        <img class="image-secondary" src="images/hp-1-featured-11.jpg" alt="product">
                                    </a>
                                    <a href="#" class="onsale">SALE</a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Ta-bl Side Table</a></h5>
                                    <span class="price">
												<del>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														35
													</span>
												</del>
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														22
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product 2 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img src="images/hp-1-featured-2.jpg" alt="product">
                                    </a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Pendant Lamp</a></h5>
                                    <span class="price">
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														45
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product 3 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img class="image-cover" src="images/hp-1-featured-3.jpg" alt="product">
                                        <img class="image-secondary" src="images/hp-1-featured-33.jpg" alt="product">
                                    </a>
                                    <a href="#" class="onnew">NEW</a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Magnolia Dream</a></h5>
                                    <span class="price">
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														18
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product 4 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img class="image-cover" src="images/hp-1-featured-4.jpg" alt="product">
                                        <img class="image-secondary" src="images/hp-1-featured-44.jpg" alt="product">
                                    </a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Elephant Chair</a></h5>
                                    <span class="price">
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														56
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Product 5 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img src="images/hp-1-featured-6.jpg" alt="product">
                                    </a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Laundry Bag</a></h5>
                                    <span class="price">
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														37
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product 6 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img class="image-cover" src="images/hp-1-featured-7.jpg" alt="product">
                                        <img class="image-secondary" src="images/hp-1-featured-77.jpg" alt="product">
                                    </a>
                                    <a href="#" class="onnew">NEW</a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Hocko Blanket</a></h5>
                                    <span class="price">
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														42
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product 7 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img class="image-cover" src="images/hp-1-featured-8.jpg" alt="product">
                                        <img class="image-secondary" src="images/hp-1-featured-88.jpg" alt="product">
                                    </a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Tweed Armchair</a></h5>
                                    <span class="price">
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														31
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product 8 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img class="image-cover" src="images/hp-1-featured-9.jpg" alt="product">
                                        <img class="image-secondary" src="images/hp-1-featured-99.jpg" alt="product">
                                    </a>
                                    <a href="#" class="onsale">SALE</a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Low Table/Stool</a></h5>
                                    <span class="price">
												<del>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														49
													</span>
												</del>
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														29
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Product 9 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img src="images/hp-1-featured-13.jpg" alt="product">
                                    </a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Forrest Vase B</a></h5>
                                    <span class="price">
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														45
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product 10 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img class="image-cover" src="images/hp-1-featured-14.jpg" alt="product">
                                    </a>
                                    <a href="#" class="onsale">SALE</a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Hocko Blanket</a></h5>
                                    <span class="price">
												<del>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														30
													</span>
												</del>
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														28
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product 11 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img class="image-cover" src="images/hp-1-featured-5.jpg" alt="product">
                                        <img class="image-secondary" src="images/hp-1-featured-55.jpg" alt="product">
                                    </a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Planting Light</a></h5>
                                    <span class="price">
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														41
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product 12 -->
                    <div class="col">
                        <div class="product type-product">
                            <div class="woocommerce-LoopProduct-link">
                                <div class="product-image">
                                    <a href="#" class="wp-post-image">
                                        <img class="image-cover" src="images/hp-1-featured-10.jpg" alt="product">
                                    </a>
                                    <a href="#" class="onnew">NEW</a>
                                    <div class="yith-wcwl-add-button show">
                                        <a href="#" class="add_to_wishlist">
                                            <i class="zmdi zmdi-favorite-outline"></i>
                                        </a>
                                    </div>
                                    <div class="button add_to_cart_button">
                                        <a href="#">
                                            <img src="images/icons/shopping-cart-black-icon.png" alt="cart">
                                        </a>
                                    </div>
                                    <h5 class="woocommerce-loop-product__title"><a href="#">Cushion Cover</a></h5>
                                    <span class="price">
												<ins>
													<span class="woocommerce-Price-amount amount">
														<span class="woocommerce-Price-currencySymbol">$</span>
														12
													</span>
												</ins>
											</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navigation pagination">
                <div class="page-numbers">
                    <a href="#" class="page-numbers current">
                        <span>1</span>
                    </a>
                    <a href="#" class="page-numbers">
                        <span>2</span>
                    </a>
                    <a href="#" class="page-numbers">
                        <span>3</span>
                    </a>
                    <a href="#" class="page-numbers">
                        <span><i class="zmdi zmdi-chevron-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Section -->
@endsection
