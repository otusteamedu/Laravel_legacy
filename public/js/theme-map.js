(function ($) {
  // USE STRICT
  "use strict";

  var mapSelector = $('.js-google-map');

  function addMaker(makers, map, icon) {
      var marker, i;
      var infowindow = new google.maps.InfoWindow();
      for (i = 0; i < makers.length; i++) {
          var mapText = '<div class="map__box-info"><h4>'+ makers[i][0] +'</h4><p>'+ makers[i][1] +'</p></div>';
          marker = new google.maps.Marker({
              position: new google.maps.LatLng(makers[i][2], makers[i][3]),
              map: map,
              icon: icon,
              animation: google.maps.Animation.DROP
          });
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
              return function() {
                  infowindow.setContent(mapText);
                  infowindow.open(map, marker);
              }
          })(marker, i));
      }
  }

  mapSelector.each(function () {
      var that = $(this);

      var mapStyleDefault = [
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#d3d3d3"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "color": "#808080"
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#b3b3b3"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            },
            {
                "weight": 1.8
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#d7d7d7"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ebebeb"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#a7a7a7"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#efefef"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#696969"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#737373"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#d6d6d6"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {},
    {
        "featureType": "poi",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#dadada"
            }
        ]
    }
];

      var mapHolder = that.find('.js-map-holder');
      var idMapHolder = mapHolder.attr('id');

      var options = {
          makericon: 'images/icons/map-icon.png',
          makers: '[["New Jersey", "Content", 40.786813, -73.834441]]',
          zoom : 11,
          center: new google.maps.LatLng(40.786813, -73.834441),
          scrollwheel: 0,
          navigationcontrol: true,
          maptypecontrol: false,
          scalecontrol: false,
          draggable: 1,
          styles: mapStyleDefault,
          maptypeId: google.maps.MapTypeId.ROADMAP
      };

      for (var k in options) {
          if (options.hasOwnProperty(k)) {
              if ($(this).attr('data-' + k) != null) {
                  options[k] = $(this).attr("data-"+k);
              }
          }
      }

      var locations = $.parseJSON(options.makers);
      var bound = new google.maps.LatLngBounds();

      for (var i = 0; i < locations.length; i++) {
          bound.extend(new google.maps.LatLng(locations[i][2], locations[i][3]));
      }

      var mapOptions = {
          zoom: options.zoom,
          scrollwheel: options.scrollwheel,
          navigationControl: options.navigationcontrol,
          mapTypeControl: options.maptypecontrol,
          scaleControl: options.scalecontrol,
          draggable: options.draggable,
          styles: options.styles,
          center: bound.getCenter(),
          mapTypeId: options.maptypeId
      };

      var mapAPI = new google.maps.Map(document.getElementById(idMapHolder), mapOptions);
      addMaker(locations, mapAPI, options.makericon);
  });

})(jQuery);