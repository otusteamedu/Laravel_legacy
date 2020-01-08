@extends('public.movies.layout')

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home'),
        ], [
            'url' => \route('public.movies.search'),
            'title' => __('public.menu.showing'),
        ], [
            'url' => \route('public.movies.view', ['id' => $movie['id']]),
            'title' => $movie['name'],
        ], [
            'url' => \route('public.movies.showing', ['id' => $movie['id']]),
            'title' => __('public.showings'),
        ], [
            'url' => \route('public.movies.order', ['id' => $movie['id']]),
            'title' => __('public.order_ticket'),
        ]
    ];
@endphp

@section('pageTitle')
    {{ $movie['name'] }}: заказ билета
@endsection

@section('pageHeader')
    Заказ билета
@endsection

@section('pageContentMain')
    <div id="nodeShowing"
         data-role="showing"
         data-showing-id="{{ $showing['id'] }}"
         data-showing-date="{{ $showing['date'] }}"
         data-showing-time="{{ $showing['time'] }}"
         data-movie-name="{{ $movie['name'] }}"
         data-movie-duration="{{ $movie['duration'] }}"
    >
        <div class="container-fluid order-ticket i-iblock">
            <div class="row align-items-start m-0">
                <div class="col-md-6">
                    <h5><b>Фильм</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td width="30%"><b>Название:</b></td>
                            <td>{{ $movie['name'] }}</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Длительность:</b></td>
                            <td>{{ $movie['duration'] }} мин.</td>
                        </tr>
                        </tbody>
                    </table><br /><br />
                </div>
                <div class="col-md-6">
                    <h5><b>Место</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td width="30%"><b>Кинотеатр:</b></td>
                            <td>{{ $hall['cinema']['name'] }}. Зал: №{{ $hall['number'] }}&nbsp;&laquo;{{ $hall['name'] }}&raquo;</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Адрес:</b></td>
                            <td>{{ $hall['cinema']['address'] }}</td>
                        </tr>
                        </tbody>
                    </table><br /><br />
                </div>
                <div class="col-md-6">
                    <h5><b>Сеанс</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td width="30%"><b>Дата:</b></td>
                            <td>{{ $showing['date'] }}</td>
                        </tr>
                        </tbody>
                    </table><br /><br />
                </div>
                <div class="col-md-6">
                    <h5><b>&nbsp;</b></h5>
                    <table class="table-sm table-bordered table-striped" width="100%">
                        <tbody>
                        <tr>
                            <td width="30%"><b>Время:</b></td>
                            <td>{{ $showing['time'] }} мин.</td>
                        </tr>
                        </tbody>
                    </table><br /><br />
                </div>
            </div>
            <div class="row align-items-start m-0">
                <div class="col-md-6">
                    <div data-role="hall" class="hall-area">
                    @foreach($places as $place)
                        <div class="place-item"
                             data-role="place"
                             data-place-id="{{ $place['id'] }}"
                             data-place-row="{{ $place['row_number'] }}"
                             data-place-place="{{ $place['place_number'] }}"
                             data-tariff-id="{{ $place['tariff']['id'] }}"
                             data-tariff-code="{{ $place['tariff']['code'] }}"
                             data-tariff-name="{{ $place['tariff']['name'] }}">
                            <span><i>{{ $place['place_number'] }}</i></span>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>Выберите места и нажмите кнопку заказать</h6>
                    <div class="message-status" data-role="message"></div>
                    <div class="places-selected" data-role="order">
                        <ul data-role="items" class="clearfix"></ul>
                        <input data-role="checkout" type="submit" class="btn btn-success shadow" value="Заказать" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br /><br />
    <div class="container-fluid">
        <a class="btn btn-primary shadow" href="{{ route('public.movies.view', ['id' => $movie['id']]) }}" role="button">
            О фильме
        </a>
        <a class="btn btn-primary shadow" href="{{ route('public.movies.search') }}" role="button">
            Вернуться
        </a>
    </div>
    <script type="text/javascript">
        var object = new jMovieShowing(document.getElementById('nodeShowing'), @json($prices), {
            urlOrder: {
                list: "{{ route('public.order.getsession') }}",
                add: "{{ route('public.order.addticket') }}",
                remove: "{{ route('public.order.removeticket') }}",
                removeitem: "{{ route('public.order.removeitem') }}",
                checkout: "{{ route('public.order.checkout') }}"
            },
            urlTicket: {
                list: "{{ route('public.movies.showing.tickets') }}"
            },
            messages: {
                ticketStatusEnabled: "{{ __('public.order.ticketStatusEnabled') }}",
                ticketStatusDisabled: "{{ __('public.order.ticketStatusDisabled') }}"
            }
        });
        object.init();
    </script>

@endsection

