
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Calendar</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>

<div class="container">

    <div class="d-flex p-2 flex-wrap bd-highlight justify-content-center text-justify " style="width: 290px;">
        <div class="d-inline-flex p-2" style="width: 35px;" >Пн.</div>
        <div class="d-inline-flex p-2" style="width: 35px;" >Вт.</div>
        <div class="d-inline-flex p-2" style="width: 35px;" >Ср.</div>
        <div class="d-inline-flex p-2" style="width: 35px;" >Чт.</div>
        <div class="d-inline-flex p-2" style="width: 35px;" >Пт.</div>
        <div class="d-inline-flex p-2 text-danger" style="width: 35px;" >Сб.</div>
        <div class="d-inline-flex p-2 text-danger" style="width: 35px;" >Вс.</div>

        @foreach ($data as $day)
            <div class="d-inline-flex p-2 text-center " >
                <a href="#" class=" text-center {{$day['workDay']}} {{ $day['anotherMonth'] }} " style="width: 19px;">
                    {{$day['dayNum']}}
                </a>
            </div>
        @endforeach

    </div>

</div>
</body>
</html>
