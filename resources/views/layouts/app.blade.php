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

<script src="{{ asset('js/dtGonza.js') }}"></script>
</body>

</html>
