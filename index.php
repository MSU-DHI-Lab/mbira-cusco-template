<?php
	require 'lib/site.php';
	include 'app/inc/head.php';

	if(is_null($projects->get($projectID))) {
		echo "Invalid project id";
		if (is_null($projectID)) {
			die("You haven't chosen project id");
		} else {
			die("Wrong project id selected, check your project list");
		}
	}

    $project = $projects->get($projectID);  	///< Load the project
    $name = $project->getName();        		///< Get project name
    $des = $project->getDes();          		///< Get project description
    $short_des = $project->getShortdes();   	///< Get project short description
	$header_path = $project->getHeaderPath(); 	///< Get project header image path
?>
<!-- formatting for this page found in project-page.css -->

<div class="main project-home">
	<div class="project-img" style="background-image: url(<?php echo $source.$header_path; ?>);">
		<div class="container">
			<div class="project-title">
				<h1><?php echo $name; ?></h1>
			</div>
		</div>
	</div>

	<!-- this nav will only appear on windows/screen more than 1024px width -->

	<div class="project-home-nav">

		<div class="container project-nav">

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

    <?php if(!isset($_SESSION['user'])) { ?>
  		<a href="login.php" class="nav-item">
  			<img src="app/styles/icons/signIn.svg" />
  			<p><span>Sign In</span></p>
  		</a>
    <?php } else { ?>
      <a href="logout.php" class="nav-item">
  			<img src="app/styles/icons/signIn.svg" />
  			<p><span>Log Out</span></p>
      </a>
    <?php } ?>


		</div>

	</div>

	<div class="project-info">

<!--
		<div class="container org-name">
			<h5>Brought to you by <?php echo "Matrix@MSU";?></h5>
		</div>
//-->

		<div class="container tag-line">
			<h3>
				<?php echo $name; ?>
			</h3>
		</div>

		<div class="container">
			<p class="project-shortDescription-home">
                <?php echo $short_des; ?>
			</p>

			<p class="project-description-home">
                <?php echo $des;  ?>
			</p>
			<p class="learn-more-home"><a href="learn-more.php">LEARN MORE</a></p>
		</div>

	</div>

	<!-- this nav will only appear on windows/screen less than 1025px width -->

	<div class="container project-nav">
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

		<a href="location.php" class="nav-item">
			<img src="app/styles/icons/random.svg" />
			<p><span>Random Place</span></p>
		</a>

		<a href="learn-more.php" class="nav-item">
			<img src="app/styles/icons/info.svg" />
			<p><span>Learn More</span></p>
		</a>

  <?php if(!isset($_SESSION['user'])) { ?>
		<a href="login.php" class="nav-item">
			<img src="app/styles/icons/signIn.svg" />
			<p><span>Sign In</span></p>
		</a>
  <?php } else { ?>
    <a href="logout.php" class="nav-item">
			<img src="app/styles/icons/signIn.svg" />
			<p><span>Log Out</span></p>
    </a>
  <?php } ?>

	</div>
</div>

<?php
	include 'app/inc/footer.php';
?>
