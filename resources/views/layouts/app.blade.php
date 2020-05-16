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
        <header id="header" class="main">
            <div class="hbox">
                <div class="logo">
                    <a href="/">
                        <h1 class="text">Sckatik-tv</h1>
                    </a>
                </div>
                <div class="head-main-nav">
                    <div class="menu-header-menu-container">
                        <ul id="main-header" class="main-header">
                            <li id="menu-item-3315" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3315">
                                <a href="#">Жанры</a>
                                <ul class="sub-menu">
                                    <li id="menu-item-3326" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3326"><a href="https://sckatik.ru/category/anime/">Аниме</a></li>
                                    <li id="menu-item-3327" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3327"><a href="https://sckatik.ru/category/biografiya/">Биография</a></li>
                                    <li id="menu-item-3328" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3328"><a href="https://sckatik.ru/category/boeviki/">Боевики</a></li>
                                    <li id="menu-item-3329" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3329"><a href="https://sckatik.ru/category/vestern/">вестерн</a></li>
                                    <li id="menu-item-3330" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3330"><a href="https://sckatik.ru/category/voennyj/">военный</a></li>
                                    <li id="menu-item-3331" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3331"><a href="https://sckatik.ru/category/detektiv/">Детектив</a></li>
                                    <li id="menu-item-3332" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3332"><a href="https://sckatik.ru/category/dorama/">Дорама</a></li>
                                    <li id="menu-item-3333" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3333"><a href="https://sckatik.ru/category/drama/">Драма</a></li>
                                    <li id="menu-item-3334" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3334"><a href="https://sckatik.ru/category/istoriya/">история</a></li>
                                    <li id="menu-item-3335" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3335"><a href="https://sckatik.ru/category/komediya/">Комедия</a></li>
                                    <li id="menu-item-3336" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3336"><a href="https://sckatik.ru/category/kriminal/">Криминал</a></li>
                                    <li id="menu-item-3337" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3337"><a href="https://sckatik.ru/category/melodrama/">Мелодрама</a></li>
                                    <li id="menu-item-3338" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3338"><a href="https://sckatik.ru/category/mistika/">Мистика</a></li>
                                    <li id="menu-item-3339" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3339"><a href="https://sckatik.ru/category/muzyka/">музыка</a></li>
                                    <li id="menu-item-3340" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3340"><a href="https://sckatik.ru/category/multfilmy/">Мультфильмы</a></li>
                                    <li id="menu-item-3341" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3341"><a href="https://sckatik.ru/category/myuzikl/">Мюзикл</a></li>
                                    <li id="menu-item-3342" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3342"><a href="https://sckatik.ru/category/parodiya/">пародия</a></li>
                                    <li id="menu-item-3343" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3343"><a href="https://sckatik.ru/category/priklyucheniya/">Приключения</a></li>
                                    <li id="menu-item-3344" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3344"><a href="https://sckatik.ru/category/romantika/">Романтика</a></li>
                                    <li id="menu-item-3345" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3345"><a href="https://sckatik.ru/category/semejnyj/">Семейный</a></li>
                                    <li id="menu-item-3346" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3346"><a href="https://sckatik.ru/category/serialy/">Сериалы</a></li>
                                    <li id="menu-item-3347" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3347"><a href="https://sckatik.ru/category/sport/">спорт</a></li>
                                    <li id="menu-item-3348" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3348"><a href="https://sckatik.ru/category/triller/">Триллер</a></li>
                                    <li id="menu-item-3349" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3349"><a href="https://sckatik.ru/category/uzhasy/">Ужасы</a></li>
                                    <li id="menu-item-3350" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3350"><a href="https://sckatik.ru/category/fantastika/">Фантастика</a></li>
                                    <li id="menu-item-3351" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3351"><a href="https://sckatik.ru/category/fentezi/">Фэнтези</a></li>
                                    <li id="menu-item-3352" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-3352"><a href="https://sckatik.ru/category/erotika/">эротика</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="headitems register_active ">
                    <div id="advc-menu" class="search">
                        <form method="get" id="searchform" action="">
                            <input type="text" placeholder="Найти..." name="s" id="s" value="" autocomplete="off">
                            <button class="search-button" type="submit"><span class="icon-search2"></span></button>
                        </form>
                    </div>
                    <!-- end search -->
                    <!-- end dt_user -->
                </div>
                <div class="live-search ltr"></div>
            </div>
        </header>
        <div class="fixheadresp">
            <header class="responsive">
                <div class="nav"><a class="aresp nav-resp"></a></div>
                <div class="search"><a class="aresp search-resp"></a></div>
                <div class="logo">
                    <a href="/">
                        <h1 class="text">Sckatik-tv</h1>
                    </a>
                </div>
            </header>
        </div>
        <div id="contenedor">
           <div class="letter_home">
               <div class="fixresp">
                   <ul class="glossary">
                     <li>
                        <a class="lglossary" data-type="all" data-glossary="all">#</a>
                     </li>
                     <li><a class="lglossary" data-type="all" data-glossary="А">А</a></li>
                   </ul>
               </div>
               <div class="items_glossary"></div>
            </div>
            <div class="module">
                <div class="content ">
                    <div id="slider-movies-tvshows" class="animation-1 slider">
                        <article class="item" id="post-1">
                            <div class="image">
                                <a href="#">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/Wonder_Woman_hero_Wonder_Woman_2017_film_Gal_529948_3840x2400-300x188.jpg" />
                                </a>
                                <a href="#">
                                    <div class="data">
                                        <h3 class="title">
                                            Название фильма
                                        </h3>
                                        <span>
                                           2020</span>
                                    </div>
                                </a>
                                <span class="item_type">Фильм</span>
                            </div>
                        </article>
                        <article class="item" id="post-1">
                            <div class="image">
                                <a href="#">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/Wonder_Woman_hero_Wonder_Woman_2017_film_Gal_529948_3840x2400-300x188.jpg" />
                                </a>
                                <a href="#">
                                    <div class="data">
                                        <h3 class="title">
                                            Название фильма
                                        </h3>
                                        <span>
                                           2020</span>
                                    </div>
                                </a>
                                <span class="item_type">Фильм</span>
                            </div>
                        </article>
                        <article class="item" id="post-1">
                            <div class="image">
                                <a href="#">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/Wonder_Woman_hero_Wonder_Woman_2017_film_Gal_529948_3840x2400-300x188.jpg" />
                                </a>
                                <a href="#">
                                    <div class="data">
                                        <h3 class="title">
                                            Название фильма
                                        </h3>
                                        <span>
                                           2020</span>
                                    </div>
                                </a>
                                <span class="item_type">Фильм</span>
                            </div>
                        </article>
                    </div>
                    <header>
                        <h2>Боевики</h2>
                        <div class="nav_items_module dt-boeviki">
                            <a class="btn prev3">
                                <i class="icon-caret-left"></i>
                            </a>
                            <a class="btn next3">
                                <i class="icon-caret-right"></i>
                            </a>
                        </div>
                        <span>27<a href="/category/boeviki/" class="see-all">Посмотреть все</a>
                        </span>
                    </header>
                    <div id="dt-boeviki" class="items owl-carousel owl-theme" >
                        <article id="post-1" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating">
                                        <i class="icon-star2 color-yellow"></i>
                                        7.79
                                    </div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                        <article id="post-2" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating">
                                        <i class="icon-star2 color-yellow"></i>
                                        7.79
                                    </div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                        <article id="post-3" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating">
                                        <i class="icon-star2 color-yellow"></i>
                                        7.79
                                    </div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                        <article id="post-4" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating">
                                        <i class="icon-star2 color-yellow"></i>
                                        7.79
                                    </div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                        <article id="post-5" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating">
                                        <i class="icon-star2 color-yellow"></i>
                                        7.79
                                    </div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                        <article id="post-6" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating">
                                        <i class="icon-star2 color-yellow"></i>
                                        7.79
                                    </div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                        <article id="post-7" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating"><?

                                    ?></div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                        <article id="post-8" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating"><?

                                    ?></div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                        <article id="post-9" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating"><?

                                    ?></div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                        <article id="post-10" class="item movies slider-main-page">
                            <div class="poster">
                                    <img src="https://sckatik.ru/wp-content/uploads/2020/05/x1000-1-185x278.jpg" alt="фильм">
                                    <div class="rating"><?

                                    ?></div>
                                    <div class="mepo">
                                    </div>
                                    <a href="#">
                                        <div class="see"></div>
                                    </a>
                                </div>
                                <div class="data">
                                    <h3>
                                        <a href="#">Фильм
                                        </a>
                                    </h3>
                                    <span>2010</span>
                                </div>
                        </article>
                    </div>
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
