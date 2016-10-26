<?php
	require "lib/site.php";

	$project = $projects->get($projectID);      ///< Load the project
	$name = $project->getName();        ///< Get project name
	$des = $project->getDes();          ///< Get project description
	$short_des = $project->getShortdes();   ///< Get project short description

  $headerPath = $project->getHeaderPath(); //Also used by head.php
  include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';
	?>

<div class="main">
	<div class="title">
		<div class="container">
			<h1> ABOUT <?php echo $name; ?></h1>
		</div>
	</div>

	<!-- contains long-Description from mbira Kora Plugin  -->

	<div class="container">

		<p class="project-description"><?php echo $des; ?></p>

	</div>

	<div class="container exhibit-description">

	</div>


</div>

<?php
	include 'app/inc/footer.php';
?>
