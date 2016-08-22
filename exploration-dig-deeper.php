<?php
	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';
?>

<div class="main">

	<!-- returns to single location page -->

	<div class="return-location">
		<div class="dig-deeper-header">
			<div class="container header">
				<a href="location.php">
					<span class="icon arrow-left"></span>
					<p>Location</p>
				</a>

				<!-- the stop in exploration which this dig deeper is associated with -->

				<div id="location-links">
					<a href="exploration.php" class="exploration-stop">
						<p>STOP<br> x of x</p>
						<span class="icon exploration active"></span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="title">
		<div class="container">
			<h1>Dig Deeper</h1>
		</div>
	</div>

	<div class="container dig-description">
		<p>
			Cup sit carajillo affogato, con panna at, viennese froth mazagran that carajillo, to go, lungo, trifecta robusta brewed dark turkish frappuccino instant. Single origin, affogato café au lait, grounds milk, spoon redeye mug variety et cup, extra grounds aromatic grinder, americano rich grounds, black con panna cultivar cortado spoon. Single origin, grounds affogato robust affogato sweet iced qui, foam sugar dripper blue mountain turkish chicory beans acerbic in pumpkin spice in grinder french press doppio cream. Pumpkin spice siphon whipped extraction shop est galão mug latte blue mountain, turkish, in to go, variety arabica cream variety kopi-luwak. Et, organic milk latte, foam, chicory as white sweet cappuccino french press, fair trade cup aromatic beans skinny mazagran spoon robusta. Ristretto cup, ristretto, barista cortado, aged sit aromatic, americano crema, foam, pumpkin spice cup aromatic irish macchiato black dripper lungo. Half and half caramelization, dark extraction organic galão, cappuccino con panna seasonal id, aromatic single shot kopi-luwak sugar, medium milk mug to go cortado. Macchiato aroma extra aged macchiato est viennese sit single shot flavour galão medium aftertaste espresso.
		</p>
	</div>

	<div class="container project-nav show">

		<a href="#" class="nav-item">
			<img src="app/styles/icons/LocationWhite.svg" />
			<p><span>View on Map</span></p>
		</a>

		<a href="#"   class="nav-item">
			<img src="app/styles/icons/media.svg" />
			<p><span>View Media</span></p>
		</a>

		<a href="#"  class="nav-item">
			<img src="app/styles/icons/discussions.svg" />
			<p><span>View conversations</span></p>
		</a>

		<a href="#"   class="nav-item">
			<img src="app/styles/icons/arrow-left.svg" />
			<p><span>Back to Location</span></p>
		</a>


	</div>

</div>

<?php
	include 'app/inc/footer.php';
?>
