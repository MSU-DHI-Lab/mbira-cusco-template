<?php
	include 'lib/site.php';
	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';

	$id = $_GET['id'];
	$exploration = $explorations->get($id);
	$stops = $exploration->getStops();
	$locTitles = [];
	foreach($stops as $locId) {
		$location = $locations->get($locId);
		array_push($locTitles, $location->getName());
	}

	$headerPath = $exploration->getHeaderPath();
?>

<div class="main">

	<div class="exploration-img" style="background-image: url(<?php echo $source.$headerPath; ?>)">
		<div class="container">
			<div class="exploration-title">
				<h1><?php echo $exploration->getName(); ?></h1>
			</div>
		</div>
	</div>

	<div class="container exploration-description">
		<p>
			<?php echo $exploration->getDes(); ?>
		</p>

		<h2>Stops</h2>

		<ol>
		<?php
		foreach($locTitles as $locTitle) {
			echo" <li>$locTitle</li> ";
		} ?>
		</ol>

	</div>

	<div class="container project-nav show">

		<a href=<?php echo"exploration-map.php?id=".$id ?> class="nav-item">
			<img src="app/styles/icons/Exploration.svg" />
			<p><span>Start Exploration</span></p>
		</a>

  <?php
    if($explorations->getCommentsToggle($_GET['id'])[0][0] == "true"){
  ?>
		<a href="#" class="nav-item">
			<img src="app/styles/icons/discussions.svg" />
			<p><span>View conversations</span></p>
		</a>
  <?php } ?>

	</div>

</div>

<?php
	include 'app/inc/footer.php';
?>
