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

@include('blocks.header.main')


<div class="container">
    <!-- ========================= SECTION MAIN  ========================= -->
    <section class="section-main padding-y">
        <main class="card">
            <div class="card-body"> <div class="alert alert-warning">таблица составлена: тут время кэша</div>

                <table class="table table-striped table-bordered">
                    <tr>
                    <th scope="col">студент/причина</th>
                    @foreach($reasons as $reason)
                    <th scope="col">{{$reason['name']}}</th>
                    @endforeach
                    </tr>

                    @foreach($students as $student)

                    <tr>
                        <td>{{$student['name']}}</td>
                        @for ($i = 0; $i < $reasonsCount; $i++)
                        <td>{{$arTransactions[$student['id']][$reasons[$i]['id']] }}</td>
                        @endfor
                    </tr>

                    @endforeach

                </table>

            </div> <!-- card-body.// -->
        </main> <!-- card.// -->

    </section>
    <!-- ========================= SECTION MAIN END// ========================= -->

</div>

@include('blocks.footer')
</body>
</html>