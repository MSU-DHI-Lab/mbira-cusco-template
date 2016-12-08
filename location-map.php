<?php
	ob_start();

	include 'lib/site.php';

  if(isset($_GET['id'])) {
  	$id = $_GET['id'];
  	$location = $locations->get($id);
  }else {
  	header('Location: ./index.php'); 		///< go to homepage if the id is unknown
  }

  $headerPath = $location->getHeaderPath(); //Also used by head.php
  $name = $location->getName(); //Used by head.php
	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';
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

L.tileLayer(tileURL, tileParameters).addTo(locationMap);

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
