<?php
	require_once "lib/site.php";
	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';


	$count = $explorations->getCount();
	$titles = $explorations->getTitles();
	$id_table = $explorations->getIDs();
	$paths = $explorations->getPaths();

?>

<div class="main">
	<div class="title">
		<div class="container">
			<h1>Explorations</h1>
		</div>
	</div>
	
	<div class="tiles">
		
		<?php
			
			for ($x = 0; $x < $count; $x++) {
				echo '
					<a href="exploration.php?id='.$id_table[$x].'">
						<div class="tile">
							<img src="'.$source.$paths[$x].'" alt="">
							<span class="tile-name">
								<p>'.$titles[$x].'</p>
							</span>
						</div>
					</a>
				';
			}
			
		?>
		
	</div>
</div>

<?php 
	include 'app/inc/footer.php';
?>