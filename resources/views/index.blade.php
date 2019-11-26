@extends('layouts.site')
@section('content')

    <form class="form-group row mt-5">
        <div class="form-group col-md-11">
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                   placeholder="Поиск">
        </div>
        <div class="form-group col-md-1">
            <button type="submit" class="btn btn-primary">Поиск</button>
        </div>
    </form>
    <p>
        Арабский язык относится к группе семитских языков (строй семитских языков отличается от строя других языков
        преймущественно тем, что семитский корень состоит только из согласных, чаще всего из трёх). Он распространён
        во многих странах Азии и Африки.
        В настоящее время арабский язык существует в двух значительно отличающихся друг от друга формах. С одной
        стороны, имеется арабский литературный язык – общий для всех арабских стран язык образования, печати, радио,
        науки, литературы, ораторской речи. С другой стороны, имеются арабские разговорные языки, или диалекты,
        которыми пользуется население в повседневном общении. Разговорный язык каждой арабской страны отличается как
        от общеарабского литературного языка, так и от разговорных языков других арабских стран. В наших уроках речь
        пойдёт только о литературном
    </p>
    <hr>
    <div class="row jumbotron">

        <div class="col-md-6">
            <h2>Бувы</h2>
            {{--            ul[class="nav flex-column"]>(li[class="nav-item"]>a[class="nav-link active" href="/arabskie-bukvy/alif"]{Пункт $})*15           --}}
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
        <div class="col-md-6">
            <h2>Грамматика</h2>
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
@endsection
