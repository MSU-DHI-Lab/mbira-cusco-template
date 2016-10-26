<?php
	ob_start();		 // ensures anything dumped out will be caught
	include 'lib/site.php';

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$location = $locations->get($id);
	}else {
		header('Location: ./index.php'); 		///< go to homepage if the id is unknown
	}
	$exhibitId = $location->getExhibitId();
  $headerPath = $location->getHeaderPath(); //Also used by head.php
  $name = $location->getName(); //Used by head.php
	include 'app/inc/head.php';

?>


<aside id="left-sidebar">
	<div class="container project-nav">
		<a href=<?php echo "location-map.php?id=$id";?> class="nav-item">
			<img src="app/styles/icons/map.svg" />
			<p><span>VIEW ON MAP</span></p>
		</a>

    <?php
      if($locations->getDigDeeperToggle($_GET['id'])[0][0] == "true"){
    ?>
		<a href=<?php echo "dig-deeper.php?id=$id";?> class="nav-item">
			<img src="app/styles/icons/digdeeper.svg" />
			<p><span>DIG DEEPER</span></p>
		</a>
  <?php } ?>

  <?php
    if($locations->getMediaToggle($_GET['id'])[0][0] == "true"){
  ?>
		<a href=<?php echo "media.php?id=$id";?> class="nav-item">
			<img src="app/styles/icons/media.svg" />
			<p><span>View Media</span></p>
		</a>
  <?php } ?>

  <?php
    if($locations->getCommentsToggle($_GET['id'])[0][0] == "true"){
  ?>
		<a href=# class="nav-item">
			<img src="app/styles/icons/discussions.svg" />
			<p><span>View&nbspconversations</span></p>
		</a>
  <?php } ?>

		<a href=<?php echo "exhibit.php?id=$exhibitId";?> class="nav-item">
			<img src="app/styles/icons/Exhibits.svg" />
			<p><span>Go&nbspto&nbsplinked&nbspexhibit</span></p>
		</a>

		<a href=<?php echo "explorations.php";?> class="nav-item">
			<img src="app/styles/icons/Exploration.svg" />
			<p><span>Go&nbspto&nbsplinked&nbspexploration</span></p>
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
		</a>

		<a href="login.php" class="nav-item">
			<img src="app/styles/icons/signIn.svg" />
			<p><span><?php
				if(isset($_SESSION['user'])) {
					echo 'Log out';
				} else {
					echo 'Sign In';
				}
			?></span></p>
		</a>
	</div>
</aside>

<div class="main">

	<!-- returns to single location page -->

	<div class="location-img" style="background-image: url(<?php echo $source.$headerPath; ?>);">
		<div id="location-links">
			<div class="container header">
				<a href="exhibit.php"><img src="app/styles/icons/Exhibits.svg" class="icon exhibits" /></a>
				<a href="exploration.php"><img src="app/styles/icons/Exploration.svg" class="icon exploration" /></a>
			</div>
		</div>

		<div class="container">
			<div class="location-title">
				<h1><?php echo $location->getName(); ?></h1>
			</div>
		</div>
	</div>

	<div class="container location-description">

		<p>
			<?php echo !empty($location->getDes()) ? $location->getDes() : "No description available for this location"; ?>
		</p>
	</div>

	<div class="container project-nav show">
		<a href=<?php echo "location-map.php?id=$id";?> class="nav-item">
			<img src="app/styles/icons/map.svg" />
			<p><span>VIEW ON MAP</span></p>
		</a>

  <?php
    if($locations->getDigDeeperToggle($_GET['id'])[0][0] == "true"){
  ?>
		<a href=<?php echo"dig-deeper.php?id=$id"; ?> class="nav-item">
			<img src="app/styles/icons/digdeeper.svg" />
			<p><span>Dig Deeper</span></p>
		</a>
  <?php } ?>


  <?php
    if($locations->getMediaToggle($_GET['id'])[0][0] == "true"){
  ?>
		<a href=<?php echo "media.php?id=".$id; ?> class="nav-item">
			<img src="app/styles/icons/media.svg" />
			<p><span>view media</span></p>
		</a>
  <?php } ?>

  <?php
    if($locations->getCommentsToggle($_GET['id'])[0][0] == "true"){
  ?>
		<a href=<?php echo "conversations.php?type=location&id=".$id; ?> class="nav-item">
			<img src="app/styles/icons/discussions.svg" />
			<p><span>View conversations</span></p>
		</a>
  <?php } ?>

	</div>

</div>

<?php
	include 'app/inc/footer.php';
?>
