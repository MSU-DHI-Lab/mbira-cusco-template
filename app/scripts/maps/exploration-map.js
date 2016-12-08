// initialize map for exploration
// will need multiples instances of this file for multiple maps

var explorationMap = L.map('exploration-map').setView([42.733966, -84.482862], 15);

// sets exploration map

L.tileLayer(tileURL, tileParameters).addTo(explorationMap);

// initialize markers

var marker1 = L.marker([42.733966, -84.482862], {icon: explorationMarker1}).addTo(explorationMap);
var marker2 = L.marker([42.731963, -84.482167], {icon: explorationMarker2}).addTo(explorationMap);
var marker3 = L.marker([42.733360, -84.479169], {icon: explorationMarker2}).addTo(explorationMap);
var marker4 = L.marker([42.734180, -84.479287], {icon: explorationMarker2}).addTo(explorationMap);

// pushes markers to arrays

var markers = Array();
markers.push(marker1);
markers.push(marker2);
markers.push(marker3);
markers.push(marker4);

var latlngs = Array();

latlngs.push(marker1.getLatLng());
latlngs.push(marker2.getLatLng());
latlngs.push(marker3.getLatLng());
latlngs.push(marker4.getLatLng());

// sets line connecting all markers

var polyline = L.polyline(latlngs, {color: '#263238'}).addTo(explorationMap);

explorationMap.on('popupopen', function(centerMarker) {
    var cM = explorationMap.project(centerMarker.popup._latlng);
    cM.y -= centerMarker.popup._container.clientHeight/2
    explorationMap.setView(explorationMap.unproject(cM));
});