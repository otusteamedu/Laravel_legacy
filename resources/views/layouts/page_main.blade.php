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
            <div class="card-body">

                вывод таблицы с причинами и транзакциями

            </div> <!-- card-body.// -->
        </main> <!-- card.// -->

    </section>
    <!-- ========================= SECTION MAIN END// ========================= -->

</div>

@include('blocks.footer')
</body>
</html>