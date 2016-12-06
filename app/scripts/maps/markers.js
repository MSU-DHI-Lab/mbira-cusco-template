// custom markers for mbira maps
// marker images found in ./markers

// please replace PNG files with SVGs when available

var marker = L.icon({
    iconUrl: 'app/scripts/maps/markers/marker.png',

    iconSize:     [44, 56], // size of the icon
    iconAnchor:   [22, 50], // point of the icon which will correspond to marker's location
    popupAnchor:  [0, -58] // point from which the popup should open relative to the iconAnchor
});

var exploration = L.icon({
    iconUrl: 'app/scripts/maps/markers/marker-exploration.png',

    iconSize:     [44, 56], // size of the icon
    iconAnchor:   [22, 50], // point of the icon which will correspond to marker's location
    popupAnchor:  [0, -58] // point from which the popup should open relative to the iconAnchor
});

explorationMarkers = []

explorationMarkers.push( L.icon({
    iconUrl: 'app/scripts/maps/markers/explorationMapMarker1.svg',

    iconSize:     [39, 40], // size of the icon
    iconAnchor:   [22, 30], // point of the icon which will correspond to marker's location
    popupAnchor:  [0, -58] // point from which the popup should open relative to the iconAnchor
}) );

for (var i = 2; i < 21; i++) {
    explorationMarkers.push( L.icon({
        iconUrl: 'app/scripts/maps/markers/explorationMapMarker'+i+'.svg',

        iconSize:     [24, 24], // size of the icon
        iconAnchor:   [12, 15], // point of the icon which will correspond to marker's location
        popupAnchor:  [0, -58] // point from which the popup should open relative to the iconAnchor
    }) );    

}
