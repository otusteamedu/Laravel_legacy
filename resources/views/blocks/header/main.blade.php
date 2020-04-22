<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-md-12">
                    <a href="http://bootstrap-ecommerce.com" class="brand-wrap">
                        <img class="logo" src="images/logo.png">
                    </a> <!-- brand-wrap.// -->
                </div>
                <div class="col-xl-6 col-lg-5 col-md-6">
                    <form action="#" class="search-header">
                        <div class="input-group w-100">
                            <select class="custom-select border-right"  name="category_name">
                                <option value="">All type</option><option value="codex">Special</option>
                                <option value="comments">Only best</option>
                                <option value="content">Latest</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Search">

                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="widgets-wrap float-md-right">
                        <div class="widget-header mr-3">
                            <a href="#" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-user"></i>
                                    <span class="notify">3</span>
                                </div>
                                <small class="text"> My profile </small>
                            </a>
                        </div>
                        <div class="widget-header mr-3">
                            <a href="#" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-comment-dots"></i>
                                    <span class="notify">1</span>
                                </div>
                                <small class="text"> Message </small>
                            </a>
                        </div>
                        <div class="widget-header mr-3">
                            <a href="#" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-store"></i>
                                </div>
                                <small class="text"> Orders </small>
                            </a>
                        </div>
                        <div class="widget-header">
                            <a href="#" class="widget-view">
                                <div class="icon-area">
                                    <i class="fa fa-shopping-cart"></i>
                                </div>
                                <small class="text"> Cart </small>
                            </a>
                        </div>
                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->

    @include('blocks.nav.main')

</header> <!-- section-header.// -->