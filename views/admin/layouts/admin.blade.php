<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Styles -->
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand collapse navbar-collapse" href="/">Арабский язык</a>
        <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Выход</button>
        </form>
    </nav>
</header>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="/admin" class="nav-link active">Страницы</a></li>
                <li class="nav-item"><a href="/admin" class="nav-link ">Медиа</a></li>
                <li class="nav-item"><a href="/admin" class="nav-link ">Слова</a></li>
                <li class="nav-item"><a href="/admin" class="nav-link ">Настройки</a></li>
            </ul>
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div></div>
<footer>

</footer>
</body>
</html>
