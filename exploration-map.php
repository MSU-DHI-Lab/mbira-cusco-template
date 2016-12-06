<?php
	include 'lib/site.php';



	$explorationId = $_GET['id'];
	$exploration = $explorations->get($explorationId);

	$stops = $exploration->getStops();

	$placeList = array();

	foreach($stops as $index=>$placeId) {
		if (ord($placeId[0]) == ord("A")) {
			$place = $areas->get(substr($placeId, 1));
			empty($place) ? null : array_push($placeList, ["A", $place]);
		} else {
			$place = $locations->get($placeId);
			empty($place) ? null : array_push($placeList, [$index, $place]);
		}

	}

  $headerPath = $exploration->getHeaderPath();
	$name = $exploration->getName();
  include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';

?>

<div class="main">
	<div class="return-location">
		<a href="exploration.php?id=<?php echo $id; ?>">
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p><?php echo $exploration->getName() ?></p>
				</div>
			</span>
		</a>
	</div>

	<div id="exploration-map" class="map"></div>

</div>

<script>
	var explorationMap = L.map('exploration-map').setView([42, 104], 15);

	// sets location of map
	// please replace with MATRIX mapbox account

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
	    maxZoom: 18,
	    id: 'tommicchi.n5kf5ldi',
	    accessToken: 'pk.eyJ1IjoidG9tbWljY2hpIiwiYSI6IjQ2MDIxMWU1MTI4MjQxZWJiYjUyYmIyNTlhMWQzYjgyIn0.yTGdQTIKSmk97JN6QC-H0A'
	}).addTo(explorationMap);

	// pushes markers to arrays

	var markers = Array();
	var latlngs = Array();

	<?php
		$explorationScript = '';
		$counter = 1;

		foreach ($placeList as $place) {
			echo "console.log('$place[0]');";
			if (ord($place[0]) == ord("A")) {
				$title = addslashes($place[1]->getName());
				$des = addslashes($place[1]->getshortDes());
				$coordinates = $place[1]->getCoordinates();
				$center = $place[1]->getCenter();
				$latitude = $center[0];
				$longitude = $center[1];
				$id = $place[1]->getId();

				$explorationScript .= "var area".$counter." = L.polygon($coordinates, {color: '#36464E',fillColor: '#263238',fillOpacity: 0.5}).addTo(explorationMap);";

				$explorationScript .= "var m".$counter."Txt = '<h2>$title</h2> <p>$des</p> <a href=\"area.php?id=$id\"><div class=\"view-location\"> <p>View Area</p> <span class=\"icon arrow-right\"></span> </div></a>';area".$counter.".bindPopup(m".$counter."Txt);";

				$explorationScript .= "latlngs.push(area".$counter.".getBounds().getCenter());";
			} else {
				$latitude = $place[1]->getLatitude();
				$longitude = $place[1]->getLongitude();
				$title = $place[1]->getName();
				$des = $place[1]->getshortDes();
				$id = $place[1]->getId();

				$explorationScript .= "var marker".$counter." = L.marker([".$latitude.",".$longitude."], {icon: explorationMarkers[".($counter-1)."]}, {title:'skdfj'}).addTo(explorationMap);";
				$explorationScript .= "var m".$counter."Txt = '<h2>$title</h2> <p>$des</p> <a href=\"location.php?id=$id\"><div class=\"view-location\"> <p>View Location</p> <span class=\"icon arrow-right\"></span> </div></a>';";
				$explorationScript .= "marker".$counter.".bindPopup(m".$counter."Txt);";

				$explorationScript .= "markers.push(marker".$counter.");";
				$explorationScript .= "latlngs.push(marker".$counter.".getLatLng());";
			}
			$counter ++;
		}

		echo $explorationScript;
	?>
	// sets line connecting all markers
	var bounds = new L.LatLngBounds(latlngs);
	var polyline = L.polyline(latlngs, {color: '#263238'}).addTo(explorationMap);

	explorationMap.on('popupopen', function(centerMarker) {
	    var cM = explorationMap.project(centerMarker.popup._latlng);
	    cM.y -= centerMarker.popup._container.clientHeight/2
	    explorationMap.setView(explorationMap.unproject(cM));
	});

	explorationMap.fitBounds(bounds);
</script>


<!-- <script src="app/scripts/maps/exploration-map.js" ></script> -->

<script>
	// sets so page does not scroll, may not work on some iOS devices
	$( 'body' ).css('overflow', 'hidden');
	$( 'body' ).css('position', 'fixed');
</script>

<?php
	include 'app/inc/footer.php';
?>
