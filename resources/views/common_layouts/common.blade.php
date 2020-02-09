<!-- Stored in resources/views/common_layouts/common.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <!-- link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" -->

    <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/theme/">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <a class="btn btn-default" role="button" href="?lang=en">eng</a>
                <a class="btn btn-default" role="button" href="?lang=ru">рус</a>
            </div>
            <div class="page-header">
                <h1>@yield('h1')</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">@include('common_blocks.menu')</div>
        <div class="col-md-10">@yield('maincontent')</div>
    </div>

    <div class="row">
        <div class="col-md-12">@include('common_blocks.footer')</div>
    </div>
</div>
</body>
</html>
