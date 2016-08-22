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

var explorationMarker1 = L.icon({
    iconUrl: 'app/scripts/maps/markers/explorationMapMarker1.png',

    iconSize:     [39, 40], // size of the icon
    iconAnchor:   [22, 30], // point of the icon which will correspond to marker's location
    popupAnchor:  [0, -58] // point from which the popup should open relative to the iconAnchor
});

var explorationMarker2 = L.icon({
    iconUrl: 'app/scripts/maps/markers/explorationMapMarker2.png',

    iconSize:     [24, 24], // size of the icon
    iconAnchor:   [12, 15], // point of the icon which will correspond to marker's location
    popupAnchor:  [0, -58] // point from which the popup should open relative to the iconAnchor
});