<?php
	ob_start();		 // ensures anything dumped out will be caught

	include 'app/inc/head.php';
	include 'lib/site.php';

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$area = $areas->get($id);
	}else {
		header('Location: ./index.php'); 		///< go to homepage if the id is unknown
	}

	$exhibit = $areas->getExhibitID($id);
	$exhibitId = $exhibit[0];
	$headerPath = $area->getHeaderPath();

?>


<aside id="left-sidebar">
	<div class="container project-nav">

		<a href=<?php echo "area-map.php?id=$id";?> class="nav-item">
			<img src="app/styles/icons/map.svg" />
			<p><span>VIEW ON MAP</span></p>
		</a>

<?php
  if($areas->getDigDeeperToggle($_GET['id'])[0][0] == "true"){
?>
	<a href=<?php echo "area-dig-deeper.php?id=$id";?> class="nav-item">
		<img src="app/styles/icons/digdeeper.svg" />
		<p><span>DIG DEEPER</span></p>
	</a>
<?php } ?>

<?php
  if($areas->getMediaToggle($_GET['id'])[0][0] == "true"){
?>
	<a href=<?php echo "area-media.php?id=$id";?> class="nav-item">
		<img src="app/styles/icons/media.svg" />
		<p><span>View Media</span></p>
	</a>
<?php } ?>

<?php
  if($areas->getCommentsToggle($_GET['id'])[0][0] == "true"){
?>
	<a href="#" class="nav-item">
		<img src="app/styles/icons/discussions.svg" />
		<p><span>View Conversations</span></p>
	</a>
<?php } ?>

	<a href=<?php echo "exhibit.php?id=$exhibitId";?> class="nav-item">
		<img src="app/styles/icons/Exhibits.svg" />
		<p><span>Go to linked exhibit</span></p>
	</a>

	<a href="explorations.php" class="nav-item">
		<img src="app/styles/icons/Exploration.svg" />
		<p><span>Go to linked exploration</span></p>
	</a>

		<hr>

		<a href="exhibits.php" class="nav-item">
			<img src="app/styles/icons/Exhibits.svg" />
			<p><span>Explore Exhibits</span></p>
		</a>

		<a href="explorations.php" class="nav-item">
			<img src="app/styles/icons/Exploration.svg" />
			<p><span>View Explorations</span></p>
		</a>

		<a href="#" class="nav-item">
			<img src="app/styles/icons/LocationWhite.svg" />
			<p><span>View All Places</span></p>
		</a>

		<a href="random.php" class="nav-item">
			<img src="app/styles/icons/random.svg" />
			<p><span>Random Place</span></p>
		</a>

		<a href="learn-more.php" class="nav-item">
			<img src="app/styles/icons/info.svg" />
			<p><span>Learn More</span></p>

			<a href="#" class="nav-item">
				<img src="app/styles/icons/signIn.svg" />
				<p><span>Sign In</span></p>
			</a>
	</div>
</aside>


<div class="main">

	<!-- returns to single area page -->

	<div class="location-img" style="background-image: url(<?php echo $source.$headerPath; ?>)">
		<div id="location-links">
			<div class="container header">
				<a href="exhibit.php"><img src="app/styles/icons/Exhibits.svg" class="icon exhibits" /></a>
				<a href="exploration.php"><img src="app/styles/icons/Exploration.svg" class="icon exploration" /></a>
			</div>
		</div>

		<div class="container">
			<div class="location-title">
				<h1><?php echo $area->getName(); ?></h1>
			</div>
		</div>
	</div>

	<div class="container location-description">

		<p>
			<?php echo !empty($area->getDes()) ? $area->getDes() : "No description available for this area"; ?>
		</p>
	</div>

	<div class="container project-nav show">

		<a href=<?php echo "area-map.php?id=$id";?> class="nav-item">
			<img src="app/styles/icons/map.svg" />
			<p><span>View Area on Map</span></p>
		</a>

  <?php
    if($areas->getDigDeeperToggle($_GET['id'])[0][0] == "true"){
  ?>
		<a href=<?php echo"area-dig-deeper.php?id=$id"; ?> class="nav-item">
			<img src="app/styles/icons/digdeeper.svg" />
			<p><span>Dig Deeper</span></p>
		</a>
  <?php } ?>

  <?php
    if($areas->getMediaToggle($_GET['id'])[0][0] == "true"){
  ?>
		<a href=<?php echo "area-media.php?id=".$id; ?> class="nav-item">
			<img src="app/styles/icons/media.svg" />
			<p><span>View Media</span></p>
		</a>
  <?php } ?>


  <?php
    if($areas->getCommentsToggle($_GET['id'])[0][0] == "true"){
  ?>
		<a href=<?php echo "conversations.php?type=area&id=".$id; ?>  class="nav-item">
			<img src="app/styles/icons/discussions.svg" />
			<p><span>View Conversations</span></p>
		</a>
  <?php } ?>

	</div>

</div>

<?php
	include 'app/inc/footer.php';
?>
