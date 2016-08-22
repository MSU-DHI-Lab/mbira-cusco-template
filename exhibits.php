<?php
	require "lib/site.php";
	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';

	$count = $exhibits->getCount();
	$titles = $exhibits->getTitles();
	$id_table = $exhibits->getIDs();
	$paths = $exhibits->getPaths();


?>

<div class="main">
	<div class="title">
		<div class="container">
			<h1>Exhibits</h1>
		</div>
	</div>
	
	<!-- contains all exhibit tiles -->
	
	<div class="tiles">
		
		<?php
			
			// replace this loop with actual exhibit tiles following the same HTML formatting
			// formatting for tiles found in main.css
			
			for ($x = 0; $x < $count; $x++) {
				echo '
					<a href="exhibit.php?id='.$id_table[$x].'">
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