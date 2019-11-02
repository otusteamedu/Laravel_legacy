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
    <!--      <link href="" rel="stylesheet"/> -->
    <!-- Styles -->
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Арабский язык</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/arabskie-bukvy">Буквы <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/grammatika">Грамматика</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Отзывы</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Поиск" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
            </form>
        </div>
    </nav>
</header>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-9">
            @yield('content')
        </div>
        <div class="col-md-3 jumbotron">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 1</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 2</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 3</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 4</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 5</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 6</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 7</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 8</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 9</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 10</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 11</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 12</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 13</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 14</a></li>
                <li class="nav-item"><a href="/arabskie-bukvy/alif" class="nav-link active">Пункт 15</a></li>
            </ul>
        </div>
    </div>
</div>
<footer>
    <hr>
    <div class="container mt-5">
        <form>
            <h1 class="text-center mb-5">Задать вопрос</h1>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Вопрос</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="Вопрос"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</footer>
</body>
</html>
