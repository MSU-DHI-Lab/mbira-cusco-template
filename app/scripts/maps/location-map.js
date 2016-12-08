// initialize map for location
// will need multiples instances of this file for multiple maps

var locationMap = L.map('location-map').setView([42.733966, -84.482862], 15);

// sets location of map
// please replace with MATRIX mapbox account

L.tileLayer(tileURL, tileParameters).addTo(locationMap);

// initialize markers

var marker1 = L.marker([42.733966, -84.482862], {icon: marker}).addTo(locationMap);

// set pop ups to markers

var m1Txt = '<h2>Title</h2> <p>Description</p> <a href="location.php"><div class="view-location"> <p>View Location</p> <span class="icon arrow-right"></span> </div></a>';

marker1.bindPopup(m1Txt);