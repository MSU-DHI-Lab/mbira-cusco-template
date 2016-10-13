<?php
	ob_start();		 // ensures anything dumped out will be caught

	include 'lib/site.php';
	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$media = $areas->getMedia($id);
	}else {
		header('Location: ./index.php'); 		///< go to homepage if the id is unknown
	}
	$count = count($media);
	$source = "http://mbira.matrix.msu.edu/try/plugins/mbira_plugin/images/";
?>

<div class="main">
	<div class="return-location">
		<a href=<?php echo "area.php?id=".$id; ?>>
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p><?php echo $areas->get($id)->getName() ?></p>
				</div>
			</span>
		</a>
	</div>

	<div class="title">
		<div class="container">
			<h1>Media</h1>
		</div>
	</div>

	<!-- contains all media tiles -->

	<div class="tiles">

		<?php

			// replace this loop with actual exhibit tiles following the same HTML formatting
			// formatting for tiles found in main.css

			// placeholder picture found in ./app/img

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
				<p>Add Media</p>
			</div>
		</a>

	</div>

	<div class="convo-nav">
		<div class="container project-nav show">

			<a href=<?php echo"area-map.php?id=$id"; ?> class="nav-item">
				<img src="app/styles/icons/map.svg" />
				<p><span>View Map</span></p>
			</a>

			<a href=<?php echo"area-dig-deeper.php?id=$id"; ?> class="nav-item">
				<img src="app/styles/icons/digdeeper.svg" />
				<p><span>DIG DEEPER</span></p>
			</a>

			<a href='conversations.php' class="nav-item">
				<img src="app/styles/icons/discussions.svg" />
				<p><span>View Conversations</span></p>
			</a>

			<a href=<?php echo "location.php?id=".$id; ?>  class="nav-item">
				<img src="app/styles/icons/arrow-left.svg" />
				<p><span>Back to ARea</span></p>
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
