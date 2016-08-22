<?php
	ob_start();		 // ensures anything dumped out will be caught

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

<!-- 	return to single location page -->

	<div class="return-location">
		<a href=<?php echo "location.php?id=".$id; ?>>
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p>Location</p>
				</div>
			</span>
		</a>
	</div>

	<div class="title">
		<div class="container title-with-backButton">
			<h1>Dig Deeper</h1>
		</div>
	</div>

	<div class="container dig-description">
		<p>
			<?php echo $location->getDigDeeper(); ?> 
		</p>
	</div>

	<div class="container project-nav show">

		<a href=<?php echo "location-map.php?id=$id";?> class="nav-item">
			<img src="app/styles/icons/LocationWhite.svg" />
			<p><span>View Location on Map</span></p>
		</a>

		<a href=<?php echo "media.php?id=".$id; ?>  class="nav-item">
			<img src="app/styles/icons/media.svg" />
			<p><span>View Media</span></p>
		</a>

		<a href="#"  class="nav-item">
			<img src="app/styles/icons/discussions.svg" />
			<p><span>View Conversations</span></p>
		</a>

		<a href=<?php echo "location.php?id=".$id; ?>  class="nav-item">
			<img src="app/styles/icons/arrow-left.svg" />
			<p><span>Back to Location</span></p>
		</a>

	</div>

</div>

<?php
	include 'app/inc/footer.php';
?>
