<?php
	ob_start();		 // ensures anything dumped out will be caught

	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';
	include 'lib/site.php';

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$media = $locations->getMedia($id);
	}else {
		header('Location: ./index.php'); 		///< go to homepage if the id is unknown
	}
	$count = count($media);
?>

<div class="main">
	<div class="return-location">
		<a href=<?php echo "location.php?id=".$id; ?>>
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p><?php echo $locations->get($id)->getName() ?></p>
				</div>
			</span>
		</a>
	</div>

	<div class="title">
		<div class="container title-with-backButton">
			<h1>Media</h1>
		</div>
	</div>

	<!-- contains all media tiles -->

	<div class="tiles">

		<?php

			for ($x = 0; $x < $count; $x++) {
				if ($media[$x]['isThumb'] == 'no' || $media[$x]['description'] === '' || !empty($media[$x]['description'])) {
					echo '
						<a href="#">
							<div class="tile">
								<a href='.$source.$media[$x]['thumb_path'].' data-lightbox="image-1" data-title="'. (empty($media[$x]['description']) ? "This media item does not have a caption description." : $media[$x]['description']).'">
									<img src='.$source.$media[$x]['thumb_path'].' alt="'.$media[$x]['alt_desc'].'">
								</a>
							</div>
						</a>
					';
				}
			}

		?>

		<!-- allows user to add more media -->

		<a href="#">
			<div class="tile add-media">
				<img class="icon" src="app/styles/icons/temp/add.svg" />
				<p>Contribute Media</p>
			</div>
		</a>

	</div>

	<div class="convo-nav">
		<div class="container project-nav show">

			<a href=<?php echo"location-map.php?id=$id"; ?>  class="nav-item">
				<img src="app/styles/icons/map.svg" />
				<p><span>View Map</span></p>
			</a>

			<a href=<?php echo "dig-deeper.php?id=$id"; ?> class="nav-item">
				<img src="app/styles/icons/digdeeper.svg" />
				<p><span>DIG DEEPER</span></p>
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

</div>

<!-- init lightbox js to display media when clicked -->
<!-- modified css found in ./app/styles/vendors/lightbox/lightbox.css -->

<script src="app/scripts/vendors/lightbox/lightbox.js"></script>

<?php
	include 'app/inc/footer.php';
?>
