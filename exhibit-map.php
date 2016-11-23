<?php
	ob_start();		 // ensures anything dumped out will be caught

	include 'lib/site.php';

	$exhibitID = $_GET['id'];
	$exhibit = $exhibits->get($exhibitID);
	$locationID = $exhibits->getLocationID($exhibitID); 	/// Get associated locations' id list
	$areaID = $exhibits->getAreaID($exhibitID); 			/// Get associated areas' id list


	$locationList = array();
	$areaList = array();


	if (is_null($locationID) and is_null($areaID)) {
		header('Location: exhibit-error.php?id='.$exhibitID);
	}
	if (!empty($locationID)){
		foreach ($locationID as $id){

			$location = $locations->get($id);
			array_push($locationList,$location); 		/// Get locations and put them in the array
		}
	}
	if (!empty($areaID)){
		foreach ($areaID as $id){
			$area = $areas->get($id);
			array_push($areaList,$area);				/// Get locations and put them in the array
		}
	}

  $headerPath = $exhibit->getHeaderPath(); //Also used by head.php
  $name = $exhibit->getName(); //Used by head.php
	include 'app/inc/head.php';
  include 'app/inc/left-sidebar.php';
?>

<div class="main">
	<div class="return-location">
		<a href="exhibit.php?id=<?php echo $exhibitID; ?>">
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p><?php echo $exhibit->getName(); ?></p>
				</div>
			</span>
		</a>
	</div>

	<div id="exhibit-map" class="map"></div>

</div>

<!-- settings for exhibit map, including location, markers, area, etc. -->
<!-- multiple instances of this file will need to be created for multiple exhibit maps -->

<?php

function trim_description($description) {
	$description = addslashes($description);
	$description = trim(preg_replace('/\s\s+/', ' ', $description));
	if (strlen($description) > 140) {
		$description = substr($description, 0, 140).'...';
	}
	return $description;
}

$locationScript = "";
$groupScriptText = "var group = new L.featureGroup([";
$locationCounter = 1;			///< The index of location markers
$textCounter = 1;				///< The index of text script, share between locations and areas
$latitudeArray = [];			///< Holds all of latitudes of areas and exhibits
$longitudeArray = [];			///< Holds all of longitudes of areas and exhibits

foreach ($locationList as $location) {

	$latitude = $location->getLatitude();
	$longitude = $location->getLongitude();

	array_push($latitudeArray, $latitude);
	array_push($longitudeArray, $longitude);

	$title = addslashes($location->getName());
	$description = trim_description($location->getShortDes()) ;

	$id = $location->getId();
	$locationScript .= "var marker".$locationCounter." = L.marker([".$latitude.", ".$longitude."], {icon: marker}).addTo(exhibitMap);";
	$locationScript .= "var m".$textCounter."Txt = '<h2>".$title."</h2> <p>".$description."</p> <a href=\"location.php?id=".$id."\"><div class=\"view-location\"><p>View Location</p> <img src=\"app/styles/icons/arrow-right.svg\" class=\"icon arrow-right\"/> </div></a>';";
	$locationScript .= "marker".$locationCounter.".bindPopup(m".$locationCounter."Txt);";
	$groupScriptText .= "marker".$locationCounter.", ";
	$locationCounter ++;
	$textCounter ++;

}

$areaScript = "";
$areaCounter = 1;

foreach ($areaList as $area) {
	$id = $area->getId();

	$center = $area->getCenter();

	array_push($latitudeArray, $center[0]);
	array_push($longitudeArray, $center[1]);

	$title = addslashes($area->getName());
	$description = trim_description($area->getShortDes());

	$coordinates = $area->getCoordinates();
	$shape = $area->getShape();
	$areaScript .= "var area".$areaCounter." = L.".$shape."(".$coordinates.", {color: '#36464E',fillColor: '#263238',fillOpacity: 0.5}).addTo(exhibitMap);";
	$areaScript .= "var m".$textCounter."Txt = '<h2>".$title."</h2> <p>".$description."</p> <a href=\"area.php?id=".$id."\"><div class=\"view-location\"> <p>View Area</p> <img src=\"app/styles/icons/arrow-right.svg\" class=\"icon arrow-right\"/> </div></a>';";
	$areaScript .= "area".$areaCounter.".bindPopup(m".$textCounter."Txt);";
	$groupScriptText .= "area".$areaCounter.", ";
	$areaCounter ++;
	$textCounter ++;
	
}

$latitude = (max($latitudeArray) + min($latitudeArray)) / 2;  			///< The center latitude of the map view
$longitude = (max($longitudeArray) + min($longitudeArray)) / 2; 		///< The center longitude of the map view

$diffLatitude = max($latitudeArray) -  min($latitudeArray);
$diffLongitude = max($longitudeArray) - min($longitudeArray);

$diff = max($diffLatitude, $diffLongitude); 							///< The distance of farthest points on map

$zoomLevel = 12 - ceil($diff / 4); 										///< Calculate zoom level so that all locations&areas are displayed on map

// var_dump($zoomLevel);
// if($zoomLevel < 2) { 					/// Set minimum zoom level
// 	$zoomLevel = 4;
// }
$groupScriptText = substr($groupScriptText, 0, -2);

echo "<script>
// initialize map for exhibit
// will need multiples instances of this file for multiple maps

var exhibitMap = L.map('exhibit-map');

// sets location of map
// please replace with MATRIX mapbox account

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href=\"http://openstreetmap.org\">OpenStreetMap</a> contributors, <a href=\"http://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>, Imagery © <a href=\"http://mapbox.com\">Mapbox</a>',
    maxZoom: 18,
    id: 'tommicchi.n5kf5ldi',
    accessToken: 'pk.eyJ1IjoidG9tbWljY2hpIiwiYSI6IjQ2MDIxMWU1MTI4MjQxZWJiYjUyYmIyNTlhMWQzYjgyIn0.yTGdQTIKSmk97JN6QC-H0A'
}).addTo(exhibitMap);

exhibitMap.on('popupopen', function(centerMarker) {
    var cM = exhibitMap.project(centerMarker.popup._latlng);
    cM.y -= centerMarker.popup._container.clientHeight/2
    exhibitMap.setView(exhibitMap.unproject(cM));
});

".$locationScript.$areaScript.$groupScriptText."]); exhibitMap.fitBounds(group.getBounds());

</script>";
?>

	<script>
	// sets so page does not scroll, may not work on some iOS devices
	$( 'body' ).css('overflow', 'hidden');
	$( 'body' ).css('position', 'fixed');
</script>

<?php
	include 'app/inc/footer.php';
?>
