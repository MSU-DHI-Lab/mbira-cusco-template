<?php
	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';
	include 'lib/site.php';

	$explorationId = $_GET['id'];
	$exploration = $explorations->get($explorationId);

	$locationId = $exploration->getStops();

	$locationList = array();
	foreach ($locationId as $id) {
		$location = $locations->get($id);
		array_push($locationList, $location);
	}

?>

<div class="main">
	<div class="return-location">
		<a href="exploration.php?id=<?php echo $id; ?>">
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p>Exploration Name</p>
				</div>
			</span>
		</a>
	</div>

	<div id="exploration-map" class="map"></div>

</div>

<?php
$explorationScript = '';
$counter = 1;

foreach ($locationList as $location) {
	$latitude = $location->getLatitude();
	$longitude = $location->getLongitude();
	$title = $location->getName();
	$des = $location->getDes();
	$id = $location->getId();

	$explorationScript .= "var marker".$counter." = L.marker([".$latitude.",".$longitude."], {icon: explorationMarker".'2'."}, {title:'skdfj'}).addTo(explorationMap);";
	$explorationScript .= "var m".$counter."Txt = '<h2>".'hi'."</h2> <a href=\"location.php?id=".$id."\"><div class=\"view-location\"><p>View Location</p> <img src=\"app/styles/icons/arrow-right.svg\" class=\"icon arrow-right\"/> </div></a>';";
	$explorationScript .= "marker".$counter.".bindPopup(m".$counter."Txt);";

	$explorationScript .= "markers.push(marker".$counter.");";
	$explorationScript .= "latlngs.push(marker".$counter.".getLatLng());";
	$counter ++;
}


//echo "<script>
//
//// initialize map for exploration
//// will need multiples instances of this file for multiple maps
//
//var explorationMap = L.map('exploration-map').setView([42.733966, -84.482862], 15);
//
//// sets location of map
//// please replace with MATRIX mapbox account
//
//L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
//    attribution: 'Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors, <a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"http://mapbox.com\">Mapbox</a>',
//    maxZoom: 18,
//    id: 'tommicchi.n5kf5ldi',
//    accessToken: 'pk.eyJ1IjoidG9tbWljY2hpIiwiYSI6IjQ2MDIxMWU1MTI4MjQxZWJiYjUyYmIyNTlhMWQzYjgyIn0.yTGdQTIKSmk97JN6QC-H0A'
//}).addTo(explorationMap);
//
//// initialize markers
//// pushes markers to arrays
//
//var markers = Array();
//
//var latlngs = Array();
//
//".$explorationScript."
//
//// sets line connecting all markers
//
//var polyline = L.polyline(latlngs, {color: '#263238'}).addTo(explorationMap);
//
//</script>";
//
//?>

<script src="app/scripts/maps/exploration-map.js" ></script>
<!-- settings for exploration map, including location, markers, area, etc. -->
<!-- multiple instances of this file will need to be created for multiple exploration maps -->


<script>
	// sets so page does not scroll, may not work on some iOS devices
	$( 'body' ).css('overflow', 'hidden');
	$( 'body' ).css('position', 'fixed');
</script>

<?php
	include 'app/inc/footer.php';
?>
