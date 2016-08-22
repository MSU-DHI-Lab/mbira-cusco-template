<?php
	ob_start();		 // ensures anything dumped out will be caught

	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';
	include 'lib/site.php';

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$area = $areas->get($id);
	}else {
		header('Location: ./index.php'); 		///< go to homepage if the id is unknown
	}
?>

<div class="main">

<!-- 	return to single location page -->

	<div class="return-location">
		<a href=<?php echo "area.php?id=".$id; ?>>
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p>Area</p>
				</div>
			</span>
		</a>
	</div>

	<div class="title">
		<div class="container">
			<h1>Dig Deeper</h1>
		</div>
	</div>

	<div class="container dig-description">
		<p>
			<?php echo $area->getDigDeeper(); ?>
		</p>
	</div>

	<div class="container project-nav show">

		<a href=<?php echo "area-map.php?id=$id";?> class="nav-item">
			<img src="app/styles/icons/map.svg" />
			<p><span>View on Map</span></p>
		</a>

		<a href=<?php echo "area-media.php?id=".$id; ?>  class="nav-item">
			<img src="app/styles/icons/media.svg" />
			<p><span>View Media</span></p>
		</a>

		<a href="#" class="nav-item">
			<img src="app/styles/icons/discussions.svg" />
			<p><span>View Conversations</span></p>
		</a>

		<a href=<?php echo "area.php?id=".$id; ?> class="nav-item">
			<img src="app/styles/icons/arrow-left.svg" />
			<p><span>Back to area</span></p>
		</a>

	</div>

</div>

<?php
	include 'app/inc/footer.php';
?>
