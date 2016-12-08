// initialize map for exploration
// will need multiples instances of this file for multiple maps

var exhibitMap = L.map('exhibit-map').setView([42.733966, -84.482862], 15);

L.tileLayer(tileURL, tileParameters).addTo(.addTo(exhibitMap);

// initialize markers

var marker1 = L.marker([42.733966, -84.482862], {icon: exploration}).addTo(exhibitMap);
var marker2 = L.marker([42.731963, -84.482167], {icon: marker}).addTo(exhibitMap);

// initializes area

var area1 = L.polygon([
    [42.732758, -84.479929],
    [42.732199, -84.475551],
    [42.731018, -84.476254],
    [42.730821, -84.480013]
], {
    color: '#36464E',
    fillColor: '#263238',
    fillOpacity: 0.5
}).addTo(exhibitMap);

// set pop ups to markers and area

var m1Txt = '<h2>Title</h2> <p>Description</p> <a href="location.php"><div class="view-location"> <p>View Location</p> <span class="icon arrow-right"></span> </div></a>';
var m2Txt = '<h2>Title</h2> <p>Description</p> <a href="location.php"><div class="view-location"> <p>View Location</p> <span class="icon arrow-right"></span> </div></a>';

marker1.bindPopup(m1Txt).openPopup();
marker2.bindPopup(m2Txt);
area1.bindPopup(m2Txt);
