<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@isset($title){{ $title }}@endisset</title>
    <meta name="description" content="@isset($description){{ $description }}@endisset">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    @include('layout.styles')

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    @include('layout.left')
</aside><!-- /#left-panel -->

<!-- Left Panel -->
<!-- Right Panel -->

<div id="right-panel" class="right-panel">
    <!-- Header-->
    @include('layout.header')
    <!-- Header-->

    @if(Request::path() != '/')
        @include('layout.breadcrumbs')
    @endif

    <div class="content mt-3">

        @yield('content')


    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

@include('layout.scripts')
<script>
    (function ($) {
        "use strict";

        jQuery('#vmap').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#1de9b6',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#1de9b6', '#03a9f5'],
            normalizeFunction: 'polynomial'
        });
    })(jQuery);
</script>

</body>

</html>
