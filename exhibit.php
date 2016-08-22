<?php
	ob_start();		 

	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';
	include 'lib/site.php';

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		if($id == 0) {
			$id = 1;
		}
		$exhibit = $exhibits->get($id);
	}else {
		header('Location: ./exhibits.php');
	}

?>

<div class="main">

	<div class="exhibit-img" style="background-image: url(<?php echo $source.$exhibit->getHeaderPath() ?>);">
		<div class="container">
			<div class="exhibit-title">
				<h1><?php echo $exhibit->getName(); ?></h1>
			</div>
		</div>
	</div>

	<div class="container exhibit-description">
		<p>
			<?php echo !empty($exhibit->getDes()) ? $exhibit->getDes() : "No description available for this exhibit"; ?>
		</p>
	</div>

	<div class="container project-nav show">

		<a href=<?php echo "exhibit-map.php?id=".$id ?> class="nav-item">
			<img src="app/styles/icons/map.svg" />
			<p><span>Explore Exhibit</span></p>
		</a>

	</div>

</div>


<?php
include 'app/inc/footer.php';
?>
