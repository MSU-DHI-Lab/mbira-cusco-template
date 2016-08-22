<!-- main project navigation in left sidebar -->
<!-- please replace incorrect icons with correct ones when available -->

<aside id="left-sidebar">
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
