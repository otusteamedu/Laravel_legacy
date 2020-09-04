@php


        if (isset($offer)){
            $name = $offer->name;
            $description = $offer->description;
            $teaser_image = stripos($offer->teaser_image, 'http') === false ?'storage/'.$offer->teaser_image:$offer->teaser_image;
            $expiration_date = $offer->expiration_date;
            $lat = $offer->lat;
            $lon = $offer->lon;
        }else{
            $name = '';
            $description = '';
            $teaser_image = '';
            $expiration_date = '';
            $lat = '';
            $lon = '';
        }
@endphp

<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('project_id', 'Проект (магазин)') }}
            {{ Form::select('project_id', $projects, null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
        <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('name', 'Наименование предложения') }}
            {{ Form::text('name', $name ?? '', array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('category_id', 'Категория') }}
            {{ Form::select('category_id', $categories->pluck('name', 'id')->toArray(), null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('expiration_date', 'Дата окончания предложения') }}
            {{ Form::date('expiration_date', date('Y-m-d', strtotime($expiration_date)), array('class'=>'form-control', 'value'=>$expiration_date)) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('city_id', 'Город действия предложения') }}
            {{ Form::select('city_id', $cities->pluck('name', 'id')->toArray(), null, array('class'=>'form-control form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('teaser_image', 'Логотип акции') }}
            {{ Form::file('teaser_image', null, array('class'=>'form-control-file')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('description', 'Описание предложения') }}
            {{ Form::textarea('description', $description, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('teaser_image', 'Текущий логотип') }}
            {{ HTML::image($teaser_image, 'alt text', array('class' => 'css-class', 'height' => '300px')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('lat', 'Широта') }}
            {{ Form::text('lat', $lat, array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('lon', 'Долгота') }}
            {{ Form::text('lon', $lon, array('class'=>'form-control')) }}
        </div>
    </div>

    <div id="map" style="width:100%;height:400px;"></div>

    <script>
        function initMap() {

            var
                labelIndex = 0,
                markers = [],
                labels = [],

                saintPetersburg = {
                    lat: 59.9386300,
                    lng: 30.3141300
                },

                mapOptions = {
                    center: saintPetersburg,
                    zoom: 15
                },

                map = new google.maps.Map(document.getElementById('map'), mapOptions),

                markerCoordinates = {lat: {{$lat}}, lng: {{$lon}}},

                marker = new google.maps.Marker({
                    position: markerCoordinates,
                    map: map,
                    draggable: false,
                    title: "В этом месте будет предоставлена скидка"
                });

            markers.push(marker);

            // This event listener calls addMarker() when the map is clicked.
            google.maps.event.addListener(map, 'click', function (event) {
                clearMapOfMarkers();
                setCoordinatesToTextBoxes(event);
                addMarker(event.latLng, map);
            });

            // Sets the map on all markers in the array.
            function setMapOnAll(map) {
                for (let i = 0; i < markers.length; i++) {
                    markers[i].setMap(map);
                }
            }

            // Removes the markers from the map, but keeps them in the array.
            function clearMapOfMarkers() {
                setMapOnAll(null);
            }

            function setCoordinatesToTextBoxes(event) {
                $("input[name='lat']").val(event.latLng.lat())
                $("input[name='lon']").val(event.latLng.lng())
            }

            // Adds a marker to the map.
            function addMarker(location, map) {
                // Add the marker at the clicked location, and add the next-available label
                // from the array of alphabetical characters.
                var marker = new google.maps.Marker({
                    position: location,
                    label: labels[labelIndex++ % labels.length],
                    map: map,
                    draggable: false,
                });

                markers.push(marker);
            }
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&callback=initMap" async
            defer></script>
</div>
