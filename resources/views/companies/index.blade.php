<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Companies - Fridge</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Fridge</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">@lang('messages.home') <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/companies">@lang('messages.companies')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/products">@lang('messages.products')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/users">@lang('messages.users')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/history">@lang('messages.history')</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="container">
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Companies</li>
            </ol>
        </nav>
        <div class="jumbotron">
            <h1 class="display-4">Companies</h1>
            <p class="lead">{{ __('messages.productsHeaderDescription') }}</p>
            <a class="btn btn-primary btn-lg" href="/companies/create" role="button">Add Company</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('messages.title')</th>
                    <th scope="col">@lang('messages.created')</th>
                </tr>
            </thead>
            <tbody>
            @php
                $companies = [
                    [
                        'id' => 1,
                        'title' => 'Otus',
                        'created_at' => \Carbon\Carbon::now()->subDays(rand(0, 10)),
                    ],
                    [
                        'id' => 2,
                        'title' => 'Google',
                        'created_at' => \Carbon\Carbon::now()->subDays(rand(0, 10)),
                    ],
                    [
                        'id' => 3,
                        'title' => 'Apple',
                        'created_at' => \Carbon\Carbon::now()->subDays(rand(0, 10)),
                    ],
                ];
            @endphp
            @foreach($companies as $company)
                <tr>
                    <th scope="row">{{ $company['id'] }}</th>
                    <th>{{ $company['title'] }}</th>
                    <td>@date($company['created_at'])</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">Fridge - 2019</span>
    </div>
</footer>

<script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>