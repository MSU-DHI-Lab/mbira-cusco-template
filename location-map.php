<?php
	ob_start();
	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';
	include 'lib/site.php';

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$location = $locations->get($id);
}else {
	header('Location: ./index.php'); 		///< go to homepage if the id is unknown
}
?>

<div class="main">
	<div class="return-location">
		<a href="location.php?id=<?php echo $id; ?>">
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p><?php echo $location->getName() ?></p>
				</div>
			</span>
		</a>
	</div>

	<div id="location-map" class="map"></div>

</div>

<!-- settings for location map, including location, markers, area, etc. -->
<!-- multiple instances of this file will need to be created for multiple location maps -->
<?php
$title = addslashes($location->getName());
$des = addslashes($location->getDes());
$des = trim(preg_replace('/\s\s+/', ' ', $des));

if (strlen($des) > 140) {
	$des = substr($des, 0, 140).'...';
}

$latitude = $location->getLatitude();
$longitude = $location->getLongitude();

echo "<script>
// initialize map for location
// will need multiples instances of this file for multiple maps

var locationMap = L.map('location-map').setView([$latitude, $longitude], 15);

// sets location of map
// please replace with MATRIX mapbox account

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors, <a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"http://mapbox.com\">Mapbox</a>',
    maxZoom: 18,
    id: 'tommicchi.n5kf5ldi',
    accessToken: 'pk.eyJ1IjoidG9tbWljY2hpIiwiYSI6IjQ2MDIxMWU1MTI4MjQxZWJiYjUyYmIyNTlhMWQzYjgyIn0.yTGdQTIKSmk97JN6QC-H0A'
}).addTo(locationMap);

// initialize markers

var marker1 = L.marker([$latitude, $longitude], {icon: marker}).addTo(locationMap);

// set pop ups to markers

var m1Txt = '<h2>$title</h2> <p>$des</p> <a href=\"location.php?id=$id\"><div class=\"view-location\"> <p>View Location</p> <span class=\"icon arrow-right\"></span> </div></a>';

marker1.bindPopup(m1Txt);

locationMap.on('popupopen', function(centerMarker) {
    var cM = locationMap.project(centerMarker.popup._latlng);
    cM.y -= centerMarker.popup._container.clientHeight/2
    locationMap.setView(locationMap.unproject(cM),16, {animate: true});
});

</script>";?>

<script>
	// sets so page does not scroll, may not work on some iOS devices
	$( 'body' ).css('overflow', 'hidden');
	$( 'body' ).css('position', 'fixed');
</script>

<?php
	include 'app/inc/footer.php';
?>
