<?php
	ob_start();
  include 'lib/site.php';

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$area = $areas->get($id);
	}else {
		header('Location: ./index.php'); 		///< go to homepage if the id is unknown
	}

  $headerPath = $area->getHeaderPath(); //Also used by head.php
  $name = $area->getName(); //Used by head.php
  include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';
  
?>

<div class="main">
	<div class="return-location">
		<a href="area.php?id=<?php echo $id; ?>">
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p><?php echo $area->getName() ?></p>
				</div>
			</span>
		</a>
	</div>

	<div id="location-map" class="map"></div>

</div>

<!-- settings for location map, including location, markers, area, etc. -->
<!-- multiple instances of this file will need to be created for multiple location maps -->
<?php
$title = addslashes($area->getName());
$des = addslashes($area->getshortDes());
$coordinates = $area->getCoordinates();
$center = $area->getCenter();
$latitude = $center[0];
$longitude = $center[1];

echo "<script>
// initialize map for location
// will need multiples instances of this file for multiple maps

var areaMap = L.map('location-map').setView([$latitude, $longitude], 15);

L.tileLayer(tileURL, tileParameters).addTo(areaMap);


var area = L.polygon($coordinates, {
    color: '#36464E',
    fillColor: '#263238',
    fillOpacity: 0.5
}).addTo(areaMap);

// set pop ups to markers

var m1Txt = '<h2>$title</h2> <p>$des</p> <a href=\"area.php?id=$id\"><div class=\"view-location\"> <p>View Area</p> <span class=\"icon arrow-right\"></span> </div></a>';

area.bindPopup(m1Txt);

areaMap.on('popupopen', function(centerMarker) {
    var cM = areaMap.project(centerMarker.popup._latlng);
    cM.y -= centerMarker.popup._container.clientHeight/2
    areaMap.setView(areaMap.unproject(cM));
});

areaMap.fitBounds(area.getBounds());

</script>";?>

<script>
	// sets so page does not scroll, may not work on some iOS devices
	$( 'body' ).css('overflow', 'hidden');
	$( 'body' ).css('position', 'fixed');
</script>

<?php
	include 'app/inc/footer.php';
?>
