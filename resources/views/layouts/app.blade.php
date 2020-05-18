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
                                @include('blocks.sidebars.advertising')
                                @include('blocks.sidebars.releases')
                                @include('blocks.sidebars.topfilms')
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
            <div class="copy">&copy; 2020 by
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
