(function (A) {

    if (!Array.prototype.forEach)
        A.forEach = A.forEach || function (action, that) {
                for (var i = 0, l = this.length; i < l; i++)
                    if (i in this)
                        action.call(that, this[i], i, this);
            };

})(Array.prototype);

var mapObject;
var markers = [];
var markersData = {
    'marcadores': [
        {
            name: 'Bom dia Matosinhos',
            location_latitude: 40.5242691,
            location_longitude: -8.59806633,
            map_image_url: 'http://178.62.86.141/api/utilizadores/perfis/53.png',
            name_point: 'Daniela Bessa',
            description_point: '29 de Dezembro de 2015',
            description_pointA: 'Bom dia Matosinhos',
            url_point: 'guardadosDetalhes.php?transmissao=278'
        }, {
            name: 'teste',
            location_latitude: 40.62872314,
            location_longitude: -8.6565752,
            map_image_url: 'http://178.62.86.141/api/utilizadores/perfis/53.png',
            name_point: 'Daniela Bessa',
            description_point: '04 de Janeiro de 2016',
            description_pointA: 'teste',
            url_point: 'guardadosDetalhes.php?transmissao=282'
        }, {
            name: 'Direitinho',
            location_latitude: 40.58838654,
            location_longitude: -8.64796066,
            map_image_url: 'http://178.62.86.141/api/utilizadores/perfis/53.png',
            name_point: 'Daniela Bessa',
            description_point: '10 de Janeiro de 2016',
            description_pointA: 'Direitinho',
            url_point: 'guardadosDetalhes.php?transmissao=334'
        }, {
            name: 'Ui',
            location_latitude: 40.58839035,
            location_longitude: -8.64792156,
            map_image_url: 'http://178.62.86.141/api/utilizadores/perfis/53.png',
            name_point: 'Daniela Bessa',
            description_point: '11 de Janeiro de 2016',
            description_pointA: 'Ui',
            url_point: 'guardadosDetalhes.php?transmissao=341'
        }, {
            name: 'lab5',
            location_latitude: 40.62902069,
            location_longitude: -8.65608978,
            map_image_url: 'http://178.62.86.141/api/utilizadores/perfis/53.png',
            name_point: 'Daniela Bessa',
            description_point: '14 de Janeiro de 2016',
            description_pointA: 'lab5',
            url_point: 'guardadosDetalhes.php?transmissao=354'
        }, {
            name: 'lab5',
            location_latitude: 40.6291275,
            location_longitude: -8.65639019,
            map_image_url: 'http://178.62.86.141/api/utilizadores/perfis/53.png',
            name_point: 'Daniela Bessa',
            description_point: '14 de Janeiro de 2016',
            description_pointA: 'lab5',
            url_point: 'guardadosDetalhes.php?transmissao=355'
        }, {
            name: 'lab5',
            location_latitude: 40.6291275,
            location_longitude: -8.65637112,
            map_image_url: 'http://178.62.86.141/api/utilizadores/perfis/53.png',
            name_point: 'Daniela Bessa',
            description_point: '14 de Janeiro de 2016',
            description_pointA: 'lab5',
            url_point: 'guardadosDetalhes.php?transmissao=359'
        }, {
            name: 'fhgh',
            location_latitude: 40.62965775,
            location_longitude: -8.65574551,
            map_image_url: 'http://178.62.86.141/api/utilizadores/perfis/53.png',
            name_point: 'Daniela Bessa',
            description_point: '15 de Fevereiro de 2016',
            description_pointA: 'fhgh',
            url_point: 'guardadosDetalhes.php?transmissao=361'
        },
        {
            name: 'fhgh',
            location_latitude: 51.5287718,
            location_longitude: 0.2416802,
            map_image_url: 'http://178.62.86.141/api/utilizadores/perfis/53.png',
            name_point: 'Daniela Bessa',
            description_point: '15 de Fevereiro de 2016',
            description_pointA: 'fhgh',
            url_point: 'guardadosDetalhes.php?transmissao=361'
        }
    ]
};


function initialize() {

    var styles = [{
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [{"color": "#444444"}]
    }, {
        "featureType": "administrative.locality",
        "elementType": "labels.text",
        "stylers": [{"visibility": "on"}]
    }, {
        "featureType": "administrative.neighborhood",
        "elementType": "labels.text",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [{"color": "#e1e1e1"}, {"saturation": "0"}]
    }, {
        "featureType": "poi",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#d1d1d1"}]
    }, {
        "featureType": "poi.attraction",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "off"}, {"color": "#d1d1d1"}]
    }, {
        "featureType": "poi.attraction",
        "elementType": "labels.text",
        "stylers": [{"visibility": "on"}]
    }, {
        "featureType": "poi.business",
        "elementType": "geometry.fill",
        "stylers": [{"saturation": "-3"}, {"lightness": "-4"}, {"gamma": "4.82"}, {"weight": "1.39"}, {"visibility": "off"}]
    }, {
        "featureType": "poi.business",
        "elementType": "labels.text",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "poi.business",
        "elementType": "labels.icon",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "poi.government",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#d1d1d1"}, {"visibility": "off"}]
    }, {
        "featureType": "poi.medical",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "off"}, {"color": "#d1d1d1"}]
    }, {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}, {"color": "#ebebeb"}]
    }, {
        "featureType": "poi.park",
        "elementType": "labels",
        "stylers": [{"visibility": "on"}]
    }, {
        "featureType": "poi.place_of_worship",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}, {"color": "#d1d1d1"}]
    }, {
        "featureType": "poi.school",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#d1d1d1"}, {"visibility": "off"}]
    }, {
        "featureType": "poi.sports_complex",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}, {"color": "#d1d1d1"}]
    }, {
        "featureType": "road",
        "elementType": "all",
        "stylers": [{"saturation": -100}, {"lightness": 45}]
    }, {
        "featureType": "road",
        "elementType": "labels.text.fill",
        "stylers": [{"color": "#333333"}]
    }, {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#ffffff"}, {"visibility": "on"}]
    }, {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "road.highway",
        "elementType": "labels",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [{"saturation": "6"}, {"hue": "#ff0000"}, {"visibility": "on"}]
    }, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"}]}, {
        "featureType": "transit",
        "elementType": "labels",
        "stylers": [{"visibility": "on"}]
    }, {
        "featureType": "transit",
        "elementType": "labels.text.fill",
        "stylers": [{"color": "#333333"}]
    }, {
        "featureType": "water",
        "elementType": "all",
        "stylers": [{"color": "#00667d"}, {"visibility": "on"}]
    }, {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#cecece"}]
    }, {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [{"color": "#ffffff"}]
    }, {"featureType": "water", "elementType": "labels.text.stroke", "stylers": [{"visibility": "off"}]}];
    var mapOptions = {
        zoom: 11,
        center: new google.maps.LatLng(40.585389, -8.543274),
        mapTypeId: google.maps.MapTypeId.ROADMAP,

        mapTypeControl: false,
        panControl: true,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        scaleControl: true,
        streetViewControl: false,
        styles: styles
    };
    var marker;

    var bounds = new google.maps.LatLngBounds();

    mapObject = new google.maps.Map(document.getElementById('map_students'), mapOptions);

    for (var key in markersData) {
        markersData[key].forEach(function (item) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                map: mapObject,
                icon: '../images/marcador/marcador.png'
            });

            bounds.extend(marker.position);

            if ('undefined' === typeof markers[key])
                markers[key] = [];

            markers[key].push(marker);
            google.maps.event.addListener(marker, 'click', (function () {
                closeInfoBox();
                getInfoBox(item).open(mapObject, this);
                mapObject.panTo(new google.maps.LatLng(item.location_latitude, item.location_longitude));
            }));
        });
    }

    mapObject.fitBounds(bounds);

    var clusterStyles = [
        {
            textColor: 'white',
            url: '../images/marcador/m1.png',
            height: 45,
            width: 44
        },
        {
            textColor: 'white',
            url: '../images/marcador/m1.png',
            height: 52,
            width: 51
        }
    ];
    var mcOptions = {gridSize: 50, maxZoom: 15, styles: clusterStyles};
    var markerCluster = new MarkerClusterer(mapObject, markers[key], mcOptions);
}

function closeInfoBox() {
    $('div.infoBox').remove();
}

function getInfoBox(item) {
    return new InfoBox({
        content: '<div class="marker_info none" id="marker_info">' +
        '<div class="info" id="info">' +
        '<img src="' + item.map_image_url + '" class="logotype" alt=""/>' +
        '<h2>' + item.name_point + '<span></span></h2>' +
        '<span><h4>Função</h4>' + item.description_pointA + '</span>' +
        '<span><h4>Empresa</h4>' + item.description_point + '</span>' +
        '<span><h4>Conclusão</h4>' + item.description_pointA + '</span>' +
        '<span class="arrow"></span>' +
        '</div>' +
        '</div>',
        disableAutoPan: true,
        maxWidth: 0,
        pixelOffset: new google.maps.Size(35, -234),
        closeBoxMargin: '50px 200px',
        closeBoxURL: '',
        isHidden: false,
        pane: 'floatPane',
        enableEventPropagation: true
    });
}

window.onload = function (e) {
    initialize()
};
