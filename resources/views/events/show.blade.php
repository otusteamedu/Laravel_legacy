@extends('layouts.app')
@include('layouts.blocks.yandexmap.scripts')
@section("content")
    <script>
        function showMap() {
            yandexMap = getYandexMap();

            ymaps.ready(yandexMap);
        }

        setTimeout(showMap, 2000);
    </script>
    <div class="row">
        <div class="col-12">
            <div class="event-map-detail">
                <div id="map"></div>
            </div>
        </div>
        <div class="col-12">
            
        </div>
    </div>
@stop
