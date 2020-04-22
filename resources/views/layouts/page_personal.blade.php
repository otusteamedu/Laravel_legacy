<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@isset($title){{ $title }}@endisset</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

    @include('layouts.scripts')
    @include('layouts.styles')

</head>
<body>
@include('blocks.header.auth')

@include('blocks.breadcrumps')

<div class="container">
    <div class="row py-5">
        <div class="col-12 col-md-4">
            @include('blocks.menu_left.personal')
        </div>
        <div class="col-12 col-md-8">
            Контент

            <div class="my-block-style">
                мой стил из common.css
            </div>
        </div>
    </div>
</div>


@include('blocks.footer')
</body>
</html>