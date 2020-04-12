@extends('layouts.app')

@section("content")
    <!--Main layout-->
    <div class="row">
        <div class="col-4">
            <div class="list-group">
                @foreach ($eventList as $event)
                    <div class="event-item p-1">
                        <a href="{{ route('events.show', $event) }}" class="row h-100">
                            <span class="col-1"></span>
                            <span class="h-100 col-3">
                                <span class="row h-75 justify-content-center">
                                    <span class="col-md-auto col align-self-center">
                                        <img src="{{ $event->getMainPicture() }}" class="img-fluid"
                                             alt="{{ $event->getShortDescription() }}"
                                             data-was-processed="true">
                                    </span>
                                </span>
                            </span>
                            <span class="col-7">
                                <span class="row">
                                    <span class="col-9 align-top">{{ $event->getHowLongWasCreated() }}</span>
                                    <span class="event-type-svg col-3 align-middle">{!! $event->getTypePicture() !!}</span>
                                    <span class="col-12">
                                        <svg viewBox="0 0 20 20" width="15" height="15" fill="#333333"><path d="M10 15L6.194 9.625A5.088 5.088 0 0110 1.25a5.05 5.05 0 015 5.081 5.125 5.125 0 01-1.125 3.206L10 15zm0-12.5a3.794 3.794 0 00-3.75 3.831c.004.918.334 1.804.931 2.5L10 12.825l2.894-4.075a3.9 3.9 0 00.856-2.419A3.794 3.794 0 0010 2.5z"></path><path d="M10 6.875a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5zM17.5 7.5h-1.25v1.25h1.25v8.75h-15V8.75h1.25V7.5H2.5a1.25 1.25 0 00-1.25 1.25v8.75a1.25 1.25 0 001.25 1.25h15a1.25 1.25 0 001.25-1.25V8.75A1.25 1.25 0 0017.5 7.5z"></path></svg>
                                        <small>{{ $event->getCountryName() }} {{ $event->region }}</small>
                                    </span>
                                    <span class="col-12">
                                        <span class="author-name-picture">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="15" height="15" x="0px" y="0px" viewBox="0 0 248.349 248.349" style="enable-background:new 0 0 248.349 248.349;" xml:space="preserve"><g><g><path style="fill:#010002;" d="M9.954,241.305h228.441c3.051,0,5.896-1.246,7.805-3.416c1.659-1.882,2.393-4.27,2.078-6.723 c-5.357-41.734-31.019-76.511-66.15-95.053c-14.849,14.849-35.348,24.046-57.953,24.046s-43.105-9.197-57.953-24.046 C31.09,154.65,5.423,189.432,0.071,231.166c-0.315,2.453,0.424,4.846,2.078,6.723C4.058,240.059,6.903,241.305,9.954,241.305z"/><path style="fill:#010002;" d="M72.699,127.09c1.333,1.398,2.725,2.73,4.166,4.019c12.586,11.259,29.137,18.166,47.309,18.166 s34.723-6.913,47.309-18.166c1.441-1.289,2.834-2.622,4.166-4.019c1.327-1.398,2.622-2.828,3.84-4.329 c9.861-12.211,15.8-27.717,15.8-44.6c0-39.216-31.906-71.116-71.116-71.116S53.059,38.95,53.059,78.16 c0,16.883,5.939,32.39,15.8,44.6C70.072,124.262,71.366,125.687,72.699,127.09z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                                        </span>
                                        <small>{{ $event->getAuthor()->name }} {{ $event->getAuthor()->last_name }}</small>
                                    </span>
                                </span>
                            </span>
                            <span class="col-1"></span>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-2">
                {{ $eventList->links() }}
            </div>
        </div>
        <div class="col-8">
            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=c16948be-d7f9-4bc4-b244-017ff85e3739" type="text/javascript"></script>
            <script !src="">
                ymaps.ready(init);

                function getPlacemark(coordinates = [0, 0], type = 'towing') {
                    //@ToDo: переделать на осбственные иконки вместо стандартной: https://tech.yandex.ru/maps/jsbox/2.1/?from=techmapsmain
                    if (type === 'towing') {
                        return getTowingPlacemark(coordinates);
                    }

                    if (type === 'pushing') {
                        return getPushingPlacemark(coordinates);
                    }

                    if (type === 'tool') {
                        return getToolPlacemark(coordinates);
                    }

                    if (type === 'fuel') {
                        return getFuelPlacemark(coordinates);
                    }


                    if (type === 'battery') {
                        return getChargingBatteryPlacemark(coordinates);
                    }

                    if (type === 'tire') {
                        return getTireFittingPlacemark(coordinates);
                    }
                }

                function getTowingPlacemark(coordinates = [0, 0]) {
                    return new ymaps.Placemark(coordinates, {
                        balloonContent: 'towing',
                        // Зададим произвольный макет метки.
                        iconLayout: 'default#pieChart',
                        // Радиус диаграммы в пикселях.
                        iconPieChartRadius: 30,
                        // Радиус центральной части макета.
                        iconPieChartCoreRadius: 10,
                        // Стиль заливки центральной части.
                        iconPieChartCoreFillStyle: '#ffffff',
                        // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeStyle: '#ffffff',
                        // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeWidth: 3,
                        // Максимальная ширина подписи метки.
                        iconPieChartCaptionMaxWidth: 200
                    }, {
                        preset: 'islands#circleIcon',
                        iconColor: '#735184'
                    });
                }

                function getPushingPlacemark(coordinates = [0, 0]) {
                    return new ymaps.Placemark(coordinates, {
                        balloonContent: 'pushing',
                        // Зададим произвольный макет метки.
                        iconLayout: 'default#pieChart',
                        // Радиус диаграммы в пикселях.
                        iconPieChartRadius: 30,
                        // Радиус центральной части макета.
                        iconPieChartCoreRadius: 10,
                        // Стиль заливки центральной части.
                        iconPieChartCoreFillStyle: '#ffffff',
                        // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeStyle: '#ffffff',
                        // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeWidth: 3,
                        // Максимальная ширина подписи метки.
                        iconPieChartCaptionMaxWidth: 200
                    }, {
                        preset: 'islands#circleIcon',
                        iconColor: '#735184'
                    });
                }

                function getToolPlacemark(coordinates = [0, 0]) {
                    return new ymaps.Placemark(coordinates, {
                        balloonContent: 'tool',
                        // Зададим произвольный макет метки.
                        iconLayout: 'default#pieChart',
                        // Радиус диаграммы в пикселях.
                        iconPieChartRadius: 30,
                        // Радиус центральной части макета.
                        iconPieChartCoreRadius: 10,
                        // Стиль заливки центральной части.
                        iconPieChartCoreFillStyle: '#ffffff',
                        // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeStyle: '#ffffff',
                        // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeWidth: 3,
                        // Максимальная ширина подписи метки.
                        iconPieChartCaptionMaxWidth: 200
                    }, {
                        preset: 'islands#circleIcon',
                        iconColor: '#735184'
                    });
                }

                function getFuelPlacemark(coordinates = [0, 0]) {
                    return new ymaps.Placemark(coordinates, {
                        balloonContent: 'fuel',
                        // Зададим произвольный макет метки.
                        iconLayout: 'default#pieChart',
                        // Радиус диаграммы в пикселях.
                        iconPieChartRadius: 30,
                        // Радиус центральной части макета.
                        iconPieChartCoreRadius: 10,
                        // Стиль заливки центральной части.
                        iconPieChartCoreFillStyle: '#ffffff',
                        // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeStyle: '#ffffff',
                        // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeWidth: 3,
                        // Максимальная ширина подписи метки.
                        iconPieChartCaptionMaxWidth: 200
                    }, {
                        preset: 'islands#circleIcon',
                        iconColor: '#735184'
                    });
                }

                function getChargingBatteryPlacemark(coordinates = [0, 0]) {
                    return new ymaps.Placemark(coordinates, {
                        balloonContent: 'battery',
                        // Зададим произвольный макет метки.
                        iconLayout: 'default#pieChart',
                        // Радиус диаграммы в пикселях.
                        iconPieChartRadius: 30,
                        // Радиус центральной части макета.
                        iconPieChartCoreRadius: 10,
                        // Стиль заливки центральной части.
                        iconPieChartCoreFillStyle: '#ffffff',
                        // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeStyle: '#ffffff',
                        // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeWidth: 3,
                        // Максимальная ширина подписи метки.
                        iconPieChartCaptionMaxWidth: 200
                    }, {
                        preset: 'islands#circleIcon',
                        iconColor: '#735184'
                    });
                }

                function getTireFittingPlacemark(coordinates = [0, 0]) {
                    return new ymaps.Placemark(coordinates, {
                        balloonContent: 'tire',
                        // Зададим произвольный макет метки.
                        iconLayout: 'default#pieChart',
                        // Радиус диаграммы в пикселях.
                        iconPieChartRadius: 30,
                        // Радиус центральной части макета.
                        iconPieChartCoreRadius: 10,
                        // Стиль заливки центральной части.
                        iconPieChartCoreFillStyle: '#ffffff',
                        // Cтиль линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeStyle: '#ffffff',
                        // Ширина линий-разделителей секторов и внешней обводки диаграммы.
                        iconPieChartStrokeWidth: 3,
                        // Максимальная ширина подписи метки.
                        iconPieChartCaptionMaxWidth: 200
                    }, {
                        preset: 'islands#circleIcon',
                        iconColor: '#735184'
                    });
                }

                function init() {
                    var myMap = new ymaps.Map("map", {
                            center: [55.76, 37.64],
                            zoom: 10
                        }, {
                            searchControlProvider: 'yandex#search'
                        }),

                        // Создаем геообъект с типом геометрии "Точка".
                        myGeoObject = new ymaps.GeoObject({
                            // Описание геометрии.
                            geometry: {
                                type: "Point",
                                coordinates: [55.8, 37.8]
                            },
                            // Свойства.
                            properties: {
                                // Контент метки.
                                iconContent: 'Я тащусь',
                                hintContent: 'Ну давай уже тащи'
                            }
                        }, {
                            // Опции.
                            // Иконка метки будет растягиваться под размер ее содержимого.
                            preset: 'islands#blackStretchyIcon',
                            // Метку можно перемещать.
                            draggable: true
                        }),
                    /*
                    Позже сделать свои иконки*/
                    myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
                        hintContent: 'Собственный значок метки',
                        balloonContent: 'Это красивая метка'
                    }, {
                        // Опции.
                        // Необходимо указать данный тип макета.
                        iconLayout: 'default#image',
                        // Своё изображение иконки метки.
                        iconImageHref: 'https://uremont.com/static/img/map/marker.svg',
                        // Размеры метки.
                        iconImageSize: [30, 42],
                        // Смещение левого верхнего угла иконки относительно
                        // её "ножки" (точки привязки).
                        iconImageOffset: [-5, -38]
                    });

                    myMap.geoObjects
                    .add(myPlacemark);

                    myMap.geoObjects
                        .add(myGeoObject);

                    @foreach ($eventList as $event)
                        myMap.geoObjects.add(getPlacemark([{!! $event->long !!}, {!! $event->lat !!}]));
                    @endforeach
                }
            </script>
            <div id="map"></div>
        </div>
    </div>
@stop
