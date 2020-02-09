@extends("layouts.app")
@section("content")
    <div role="main" class="main">
        @include("base.slider")

        <div class="container">
            <div class="row text-center pt-3">
                <div class="col-md-10 mx-md-auto">
                    <h1 class="word-rotator slide font-weight-bold text-8 mb-3 appear-animation" data-appear-animation="fadeInUpShorter">
                        <span>Люди имеют склонность</span>
                        <span class="word-rotator-words bg-dark">
									<b class="is-visible">забывать</b>
									<b>ошибаться</b>
									<b>лукавить</b>
								</span>
                    </h1>
                    <p class="lead appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="300">
                        И это сложно исправить. Но можно проконтролировать - создайте договоренность на нашем сервисе!
                    </p>
                </div>
            </div>
        </div>
        @include("base.header")
        <div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
            <div class="home-concept mt-5">
                <div class="container">

                    <div class="row text-center">
                        <span class="sun"></span>
                        <span class="cloud"></span>
                        <div class="col-lg-2 ml-lg-auto">
                            <div class="process-image">
                                <img src="img/home/home-concept-item-1.png" alt="" />
                                <strong>Strategy</strong>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="process-image process-image-on-middle">
                                <img src="img/home/home-concept-item-2.png" alt="" />
                                <strong>Planning</strong>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="process-image">
                                <img src="img/home/home-concept-item-3.png" alt="" />
                                <strong>Build</strong>
                            </div>
                        </div>
                        <div class="col-lg-4 ml-lg-auto">
                            <div class="project-image">
                                <div id="fcSlideshow" class="fc-slideshow">
                                    <ul class="fc-slides">
                                        <li><a href="portfolio-single-wide-slider.html"><img class="img-responsive" src="img/projects/project-home-1.jpg" alt="" /></a></li>
                                        <li><a href="portfolio-single-wide-slider.html"><img class="img-responsive" src="img/projects/project-home-2.jpg" alt="" /></a></li>
                                        <li><a href="portfolio-single-wide-slider.html"><img class="img-responsive" src="img/projects/project-home-3.jpg" alt="" /></a></li>
                                    </ul>
                                </div>
                                <strong class="our-work">Our Work</strong>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container mb-5 pb-4">

            <div class="row">
                <div class="col mb-4">
                    <hr class="my-5">
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-lg-8">
                    <h2 class="font-weight-normal text-7">Our <strong class="font-weight-extra-bold">Features</strong></h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="feature-box feature-box-style-2">
                                <div class="feature-box-icon">
                                    <i class="icons icon-support text-color-primary"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="font-weight-bold text-4 mb-0">Customer Support</h4>
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa</p>
                                </div>
                            </div>
                            <div class="feature-box feature-box-style-2">
                                <div class="feature-box-icon">
                                    <i class="icons icon-doc text-color-primary"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="font-weight-bold text-4 mb-0">HTML5 / CSS3 / JS</h4>
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa</p>
                                </div>
                            </div>
                            <div class="feature-box feature-box-style-2">
                                <div class="feature-box-icon">
                                    <i class="icons icon-social-google text-color-primary"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="font-weight-bold text-4 mb-0">500+ Google Fonts</h4>
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa</p>
                                </div>
                            </div>
                            <div class="feature-box feature-box-style-2">
                                <div class="feature-box-icon">
                                    <i class="icons icon-pencil text-color-primary"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="font-weight-bold text-4 mb-0">Colors</h4>
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-box feature-box-style-2">
                                <div class="feature-box-icon">
                                    <i class="icons icon-layers text-color-primary"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="font-weight-bold text-4 mb-0">Sliders</h4>
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa</p>
                                </div>
                            </div>
                            <div class="feature-box feature-box-style-2">
                                <div class="feature-box-icon">
                                    <i class="icons icon-user text-color-primary"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="font-weight-bold text-4 mb-0">Icons</h4>
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa</p>
                                </div>
                            </div>
                            <div class="feature-box feature-box-style-2">
                                <div class="feature-box-icon">
                                    <i class="icons icon-menu text-color-primary"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="font-weight-bold text-4 mb-0">Buttons</h4>
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa</p>
                                </div>
                            </div>
                            <div class="feature-box feature-box-style-2">
                                <div class="feature-box-icon">
                                    <i class="icons icon-screen-desktop text-color-primary"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="font-weight-bold text-4 mb-0">Lightbox</h4>
                                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h2 class="font-weight-normal text-6">and more...</h2>

                    <div class="accordion accordion-modern" id="accordion">
                        <div class="card card-default">
                            <div class="card-header">
                                <h4 class="card-title m-0">
                                    <a class="accordion-toggle text-color-dark font-weight-bold" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <i class="icons icon-diamond text-color-primary"></i>
                                        Creative Websites
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="collapse show">
                                <div class="card-body text-2">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blanorem ipsum dolor sit amet, consecte.</p>
                                    <p class="mb-0">Adipiscing elit phasellus blanit ma... <a href="#" class="d-block text-color-dark font-weight-semibold pt-4">read more <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">
                            <div class="card-header">
                                <h4 class="card-title m-0">
                                    <a class="accordion-toggle text-color-dark font-weight-bold" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        <i class="icons icon-bubble text-color-primary"></i>
                                        Contact Forms
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="collapse">
                                <div class="card-body text-2">
                                    <p class="mb-0">Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">
                            <div class="card-header">
                                <h4 class="card-title m-0">
                                    <a class="accordion-toggle text-color-dark font-weight-bold" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        <i class="icons icon-grid text-color-primary"></i>
                                        Portfolio Pages
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="collapse">
                                <div class="card-body text-2">
                                    <p class="mb-0">Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="solid my-5">

            <div class="row text-center pt-4">
                <div class="col">
                    <h2 class="word-rotator slide font-weight-bold text-8 mb-2">
                        <span>We're not the only ones </span>
                        <span class="word-rotator-words bg-primary">
									<b class="is-visible">excited</b>
									<b>happy</b>
								</span>
                        <span> about Porto Template...</span>
                    </h2>
                    <h4 class="text-primary lead tall text-4">30,000 CUSTOMERS IN 100 COUNTRIES USE PORTO TEMPLATE. MEET OUR CUSTOMERS.</h4>
                </div>
            </div>

            <div class="row text-center mt-5">
                <div class="owl-carousel owl-theme carousel-center-active-item" data-plugin-options="{'responsive': {'0': {'items': 1}, '476': {'items': 1}, '768': {'items': 5}, '992': {'items': 7}, '1200': {'items': 7}}, 'autoplay': true, 'autoplayTimeout': 3000, 'dots': false}">
                    <div>
                        <img class="img-fluid" src="img/logos/logo-1.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="img/logos/logo-2.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="img/logos/logo-3.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="img/logos/logo-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="img/logos/logo-5.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="img/logos/logo-6.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="img/logos/logo-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="img/logos/logo-2.png" alt="">
                    </div>
                </div>
            </div>

        </div>

        <section class="section section-custom-map appear-animation" data-appear-animation="fadeInUpShorter">
            <section class="section section-default section-footer">
                <div class="container">
                    <div class="row mt-5 appear-animation" data-appear-animation="fadeInUpShorter">
                        <div class="col-lg-6">
                            <div class="recent-posts mb-5">
                                <h2 class="font-weight-normal text-6 mb-4"><strong class="font-weight-extra-bold">Latest</strong> Posts</h2>
                                <div class="owl-carousel owl-theme dots-title mb-0" data-plugin-options="{'items': 1, 'autoHeight': true, 'autoplay': true, 'autoplayTimeout': 8000}">
                                    <div class="row">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <article>
                                                <div class="row">
                                                    <div class="col-auto pr-0">
                                                        <div class="date">
                                                            <span class="day font-weight-extra-bold">15</span>
                                                            <span class="month text-1">JAN</span>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-1">
                                                        <h4 class="text-primary text-4"><a class="d-block" href="blog-post.html">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                        <p class="pr-4 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <a href="/" class="read-more text-color-dark font-weight-semibold text-2">read more <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="col-lg-6">
                                            <article>
                                                <div class="row">
                                                    <div class="col-auto pr-0">
                                                        <div class="date">
                                                            <span class="day font-weight-extra-bold">14</span>
                                                            <span class="month text-1">JAN</span>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-1">
                                                        <h4 class="text-primary text-4"><a class="d-block" href="blog-post.html">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                        <p class="pr-4 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <a href="/" class="read-more text-color-dark font-weight-semibold text-2">read more <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <article>
                                                <div class="row">
                                                    <div class="col-auto pr-0">
                                                        <div class="date">
                                                            <span class="day font-weight-extra-bold">13</span>
                                                            <span class="month text-1">JAN</span>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-1">
                                                        <h4 class="text-primary text-4"><a class="d-block" href="blog-post.html">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                        <p class="pr-4 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <a href="/" class="read-more text-color-dark font-weight-semibold text-2">read more <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="col-lg-6">
                                            <article>
                                                <div class="row">
                                                    <div class="col-auto pr-0">
                                                        <div class="date">
                                                            <span class="day font-weight-extra-bold">12</span>
                                                            <span class="month text-1">JAN</span>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-1">
                                                        <h4 class="text-primary text-4"><a class="d-block" href="blog-post.html">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                        <p class="pr-4 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <a href="/" class="read-more text-color-dark font-weight-semibold text-2">read more <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <article>
                                                <div class="row">
                                                    <div class="col-auto pr-0">
                                                        <div class="date">
                                                            <span class="day font-weight-extra-bold">11</span>
                                                            <span class="month text-1">JAN</span>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-1">
                                                        <h4 class="text-primary text-4"><a href="blog-post.html">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                        <p class="pr-4 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <a href="/" class="read-more text-color-dark font-weight-semibold text-2">read more <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div class="col-lg-6">
                                            <article>
                                                <div class="row">
                                                    <div class="col-auto pr-0">
                                                        <div class="date">
                                                            <span class="day font-weight-extra-bold">10</span>
                                                            <span class="month text-1">JAN</span>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-1">
                                                        <h4 class="text-primary text-4"><a href="blog-post.html">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                        <p class="pr-4 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <a href="/" class="read-more text-color-dark font-weight-semibold text-2">read more <i class="fas fa-angle-right position-relative top-1 ml-1"></i></a>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="font-weight-normal text-6 mb-4"><strong class="font-weight-extra-bold">What</strong> Client’s Say</h2>
                            <div class="row">
                                <div class="owl-carousel owl-theme dots-title dots-title-pos-2 mb-0" data-plugin-options="{'items': 1, 'autoHeight': true}">
                                    <div>
                                        <div class="col">
                                            <div class="testimonial testimonial-primary">
                                                <blockquote>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.</p>
                                                </blockquote>
                                                <div class="testimonial-arrow-down"></div>
                                                <div class="testimonial-author">
                                                    <div class="testimonial-author-thumbnail">
                                                        <img src="img/clients/client-1.jpg" class="rounded-circle" alt="">
                                                    </div>
                                                    <p><strong>John Doe</strong><span>Okler</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col">
                                            <div class="testimonial testimonial-primary">
                                                <blockquote>
                                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.</p>
                                                </blockquote>
                                                <div class="testimonial-arrow-down"></div>
                                                <div class="testimonial-author">
                                                    <div class="testimonial-author-thumbnail">
                                                        <img src="img/clients/client-1.jpg" class="rounded-circle" alt="">
                                                    </div>
                                                    <p><strong>John Doe</strong><span>Okler</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
@endsection
