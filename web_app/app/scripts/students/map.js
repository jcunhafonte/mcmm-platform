function initialize() {

    // Create an array of styles.
    var styles = [{
        "featureType": "landscape",
        "stylers": [{"saturation": -100}, {"lightness": 65}, {"visibility": "on"}]
    }, {
        "featureType": "poi",
        "stylers": [{"saturation": -100}, {"lightness": 51}, {"visibility": "simplified"}]
    }, {
        "featureType": "road.highway",
        "stylers": [{"saturation": -100}, {"visibility": "simplified"}]
    }, {
        "featureType": "road.arterial",
        "stylers": [{"saturation": -100}, {"lightness": 30}, {"visibility": "on"}]
    }, {
        "featureType": "road.local",
        "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]
    }, {
        "featureType": "transit",
        "stylers": [{"saturation": -100}, {"visibility": "simplified"}]
    }, {"featureType": "administrative.province", "stylers": [{"visibility": "off"}]}, {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [{"visibility": "on"}, {"lightness": -25}, {"saturation": -100}]
    }, {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{"hue": "#ffff00"}, {"lightness": -25}, {"saturation": -97}]
    }];

    // Create a new StyledMapType object, passing it the array of styles,
    // as well as the name to be displayed on the map type control.
    var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});

    var myLatLng = new google.maps.LatLng(40.628840, -8.656626);

    // Create a map object, and include the MapTypeId to add
    // to the map type control.
    var mapOptions = {
        zoom: 17,
        center: myLatLng,
        scrollwheel: false,
        disableDefaultUI: true,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        }
    };
    var map = new google.maps.Map(document.getElementById('map'),
        mapOptions);

    var icon = {
        url: "../images/marcador/marcador.png"
    };

    var myMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: icon
    });

    //Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');
}

google.maps.event.addDomListener(window, 'load', initialize);

