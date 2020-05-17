<!-- Основной шаблон приложения -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="yandex-verification" content="1e4b7d2cb3f2f906" />
    <meta name='wmail-verification' content='48b82434d510086788c12abce25b1a0d' />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('js/front.scrollbar.js') }}"></script>
    <script src="{{ asset('js/front.owl.js') }}"></script>
    <script src="{{ asset('js/front.scripts.js') }}"></script>
    <script src="{{ asset('js/front.livesearch.js') }}"></script>
    <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/front.owl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front.style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front.icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front.crollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colors.fusion.css') }}" rel="stylesheet">
    <link href="{{ asset('css/front.mobile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <script type='text/javascript'>
        jQuery(document).ready(function(a) {
            'false' == dtGonza.mobile && a(window).load(function() {
                a('.scrolling').mCustomScrollbar({
                    theme: 'minimal-dark',
                    scrollButtons: {
                        enable: !0
                    },
                    callbacks: {
                        onTotalScrollOffset: 100,
                        alwaysTriggerOffsets: !1
                    }
                })
            })
        });
    </script>

</head>

<body class="home blog">

    <div id="dt_contenedor">
        @yield('header')
        <div id="contenedor">
            @include('blocks.glossary.glossary')
            <div class="module">
                <div class="content ">
                    @include('blocks.content.loginbox')
                    @yield('content')
                </div>
                <div class="sidebar scrolling">
                    <div class="fixed-sidebar-blank">
                        <div class="dt_mainmeta">
                            <nav class="genres">
                                <div id="custom_html-2" ><span class="widgettitle">Реклама</span>
                                    <div class="textwidget custom-html-widget">

                                    </div>
                                </div>
                                <div class="dt_mainmeta">
                                    <nav class="releases">
                                        <h2>Год</h2>
                                        <ul class="releases scrolling " >
                                            <li><a href="https://sckatik.ru/release/2019/">2019</a></li>
                                            <li><a href="https://sckatik.ru/release/2018/">2018</a></li>
                                            <li><a href="https://sckatik.ru/release/2017/">2017</a></li>
                                            <li><a href="https://sckatik.ru/release/2016/">2016</a></li>
                                            <li><a href="https://sckatik.ru/release/2015/">2015</a></li>
                                            <li><a href="https://sckatik.ru/release/2014/">2014</a></li>
                                            <li><a href="https://sckatik.ru/release/2013/">2013</a></li>
                                            <li><a href="https://sckatik.ru/release/2012/">2012</a></li>
                                            <li><a href="https://sckatik.ru/release/2011/">2011</a></li>
                                            <li><a href="https://sckatik.ru/release/2010/">2010</a></li>
                                            <li><a href="https://sckatik.ru/release/2009/">2009</a></li>
                                            <li><a href="https://sckatik.ru/release/2008/">2008</a></li>
                                            <li><a href="https://sckatik.ru/release/2007/">2007</a></li>
                                            <li><a href="https://sckatik.ru/release/2006/">2006</a></li>
                                            <li><a href="https://sckatik.ru/release/2005/">2005</a></li>
                                            <li><a href="https://sckatik.ru/release/2004/">2004</a></li>
                                            <li><a href="https://sckatik.ru/release/2003/">2003</a></li>
                                            <li><a href="https://sckatik.ru/release/2002/">2002</a></li>
                                            <li><a href="https://sckatik.ru/release/2001/">2001</a></li>
                                            <li><a href="https://sckatik.ru/release/2000/">2000</a></li>
                                            <li><a href="https://sckatik.ru/release/1999/">1999</a></li>
                                            <li><a href="https://sckatik.ru/release/1998/">1998</a></li>
                                            <li><a href="https://sckatik.ru/release/1997/">1997</a></li>
                                            <li><a href="https://sckatik.ru/release/1996/">1996</a></li>
                                            <li><a href="https://sckatik.ru/release/1995/">1995</a></li>
                                            <li><a href="https://sckatik.ru/release/1994/">1994</a></li>
                                            <li><a href="https://sckatik.ru/release/1993/">1993</a></li>
                                            <li><a href="https://sckatik.ru/release/1992/">1992</a></li>
                                            <li><a href="https://sckatik.ru/release/1988/">1988</a></li>
                                            <li><a href="https://sckatik.ru/release/1987/">1987</a></li>
                                            <li><a href="https://sckatik.ru/release/1982/">1982</a></li>
                                            <li><a href="https://sckatik.ru/release/1980/">1980</a></li>
                                            <li><a href="https://sckatik.ru/release/1975/">1975</a></li>
                                            <li><a href="https://sckatik.ru/release/1959/">1959</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="dtw_content">
                                    <article class="w_item_b" id="post-1">
                                        <a href="#">
                                            <div class="image">
                                                <img src="https://sckatik.ru/wp-content/uploads/2018/09/kinopoisk.ru-Coco-3054379-204x300.jpg" alt="тайна коко">
                                            </div>
                                            <div class="data">
                                                <h3>Мультфильм "Тайна Коко" ("Coco") (2017) смотреть онлайн в hd 720 качестве</h3>
                                                <span class="wdate">2017</span>
                                                <span class="wextra">

                                                <b><i class="icon-star2"></i>7</b>
                                                </span>
                                            </div>
                                        </a>
                                    </article>
                                    <article class="w_item_b" id="post-2">
                                        <a href="#">
                                            <div class="image">
                                                <img src="https://sckatik.ru/wp-content/uploads/2018/09/kinopoisk.ru-Coco-3054379-204x300.jpg" alt="тайна коко">
                                            </div>
                                            <div class="data">
                                                <h3>Мультфильм "Тайна Коко" ("Coco") (2017) смотреть онлайн в hd 720 качестве</h3>
                                                <span class="wdate">2017</span>
                                                <span class="wextra">

                                                <b><i class="icon-star2"></i>7</b>
                                                </span>
                                            </div>
                                        </a>
                                    </article>
                                    <article class="w_item_b" id="post-3">
                                        <a href="#">
                                            <div class="image">
                                                <img src="https://sckatik.ru/wp-content/uploads/2018/09/kinopoisk.ru-Coco-3054379-204x300.jpg" alt="тайна коко">
                                            </div>
                                            <div class="data">
                                                <h3>Мультфильм "Тайна Коко" ("Coco") (2017) смотреть онлайн в hd 720 качестве</h3>
                                                <span class="wdate">2017</span>
                                                <span class="wextra">

                                                <b><i class="icon-star2"></i>7</b>
                                                </span>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<footer class="main">
    <div class="fbox">
        <div class="fcmpbox">
            <div class="copy">&copy; 2019 by
                <strong>Sckatik-tv</strong>. Все права защищены.<br/><br/>
            </div>
            <span class="top-page">
                <a id="top-page">
                    <i class="icon-angle-up"></i>
                </a>
            </span>
            <div class="fmenu">
                <ul id="menu-footer" class="menu">
                    <li id="menu-item-1163" class="menu-item">
                        <a href="/pravoobladatelyam/">Правообладателям</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>

<script type='text/javascript'>
    jQuery(document).ready(function($) {
        $('#featured-titles').owlCarousel({
            autoPlay: false,
            items: 4,
            stopOnHover: true,
            pagination: false,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [980, 4],
            itemsTablet: [768, 3],
            itemsTabletSmall: false,
            itemsMobile: [479, 2]
        });
        $('.nextf').click(function() {
            $('#featured-titles').trigger('owl.next')
        });
        $('.prevf').click(function() {
            $('#featured-titles').trigger('owl.prev')
        });
        $('#slider-movies-tvshows').owlCarousel({
            autoPlay: false,
            items: 2,
            stopOnHover: true,
            pagination: true,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [980, 2],
            itemsTablet: [768, 2],
            itemsTabletSmall: [600, 1],
            itemsMobile: [479, 1]
         });

         $('#dt-boeviki').owlCarousel({
            autoPlay: false,
            items: 5,
            stopOnHover: true,
            pagination: false,
            itemsDesktop: [1199, 5],
            itemsDesktopSmall: [980, 5],
            itemsTablet: [768, 4],
            itemsTabletSmall: false,
            itemsMobile: [479, 3]
        });

        $('.dt-boeviki .next3').click(function() {
            $('#dt-boeviki').trigger('owl.next')
        });
        $('.dt-boeviki .prev3').click(function() {
            $('#dt-boeviki').trigger('owl.prev')
        });

        $('#slider-movies').owlCarousel({
            autoPlay: false,
            items: 2,
            stopOnHover: true,
            pagination: true,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [980, 2],
            itemsTablet: [768, 2],
            itemsTabletSmall: [600, 1],
            itemsMobile: [479, 1]
        });
        $('#slider-tvshows').owlCarousel({
            autoPlay: false,
            items: 2,
            stopOnHover: true,
            pagination: true,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [980, 2],
            itemsTablet: [768, 2],
            itemsTabletSmall: [600, 1],
            itemsMobile: [479, 1]
        });
        $('.reset').click(function(event) {
            if (!confirm(dtGonza.reset_all)) {
                event.preventDefault()
            }
        });
        $('.addcontent').click(function(event) {
            if (!confirm(dtGonza.manually_content)) {
                event.preventDefault()
            }
        });
    });
</script>
<? //wp_footer(); // необходимо для работы плагинов и функционала  ?>

<script type='text/javascript'>
    /* <![CDATA[ */
    var dtGonza = {
        "api": 'https://'+window.location.host+'/wp-json/sckatik/search/',
        "glossary": "/ajax/",
        "nonce": "56b1b0c4c3",
        "area": ".live-search",
        "button": ".search-button",
        "more": "View all results",
        "mobile": "false",
        "reset_all": "Really you want to restart all data?",
        "manually_content": "They sure have added content manually?",
        "loading": "Loading.."
    };
    /* ]]> */
</script>
</body>

</html>
