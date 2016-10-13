<!-- Load Facebook SDK for Sharing Functionality -->
<div id="fb-root"></div>

<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>


<!-- Load Twitter SDK for Sharing Functionality -->
<script>
    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
        if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>


<!-- main header -->
<header>
	<div class="container header">

		<span id="header-left">
			<!-- will trigger off-canvas left menu drawer on screen-widths/devices less than 1025px -->
			<img src="app/styles/icons/hamburger.svg" class="icon menu"/>

			<p class="project-title-nav">
				<a href="index.php">Home</a>
			</p>
		</span>

		<!-- will trigger off-canvas top search drawer on screen-widths/devices less than 1025px -->
		<!-- will change to search box inside main header on screen-widths/devices larger than 1025px -->
		<span id="search-box">
      <form action="search.php" method="post">
			     <input type="text" name="query" placeholder="Search..." class="header-search">
      </form>
			<img src="app/styles/icons/search.svg" class="icon search"/>
		</span>

		<!-- will trigger off-canvas right menu drawer -->
		<span id="share">
			<img src="app/styles/icons/temp/share.svg" class="icon share"/>
		</span>

	</div>

	<!-- to expand background of main header search box on screen-widths/devices larger than 1025px -->
	<span id="search-box-bg"></span>
</header>


<!-- left menu drawer for screen-widths/devices less than 1025px -->
<aside id="left-menu-drawer" class="close">
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
</aside>

<!-- top search drawer for screen-widths/devices less than 1025px -->
<!-- replaced with search box inside main header -->
<aside id="top-search-drawer" class="close">
	<div class="container header">
    <form action="search.php" method="post">
  		<input type="text" name="query" class="top-drawer-search" placeholder="Search..." />
  		<button type="submit" class="submit-search">Search</button>
    </form>
	</div>
</aside>


<!-- social media/sharing options in off-canvas right drawer -->
<aside id="right-menu-drawer" class="close">
	<div class="share">

		<script>var url = window.location.href</script>

		<a href="sms:" class="nav-item social">
			<img src="app/styles/icons/temp/message.svg" />
			<p><span>Message</span></p>
		</a>

		<a href="mailto:?subject=mbira&body=Test%20Email" class="nav-item social">
			<img src="app/styles/icons/temp/mail.svg" />
			<p><span>Mail</span></p>
		</a>

		<a href="#" class="nav-item social">
			<img src="app/styles/icons/temp/link.svg" />
			<p><span>Copy Link</span></p>
		</a>

        <a href="#" class="nav-item social" onclick="javascript:window.open(
            'https://www.facebook.com/v2.3/dialog/share?skip_api_login=1&api_key=966242223397117&signed_next=1&href=' +
            url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
			<img src="app/styles/icons/temp/facebook.svg" width="7" height="14" alt="Share on Facebook" />
            <p><span>Facebook</span></p>
        </a>

		<a href="#" class="nav-item social" onclick="javascript:window.open('https://twitter.com/share?text=' +
		    'Check out this mbira link!'+ '&url=' + url, '',
		    'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=600');return false;">
            <img src="app/styles/icons/temp/twitter.svg" width="14" height="11" alt="Share on Twitter" />
			<p><span>Twitter</span></p>
		</a>

        <a href="#" class="nav-item social" onclick="javascript:window.open('https://plus.google.com/share?url=' + url, '',
            'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=700,width=600');return false;">
            <img src="app/styles/icons/temp/google-plus.svg" width="15" height="16" alt="Share on Google+" />
            <p><span>Google+</span></p>
        </a>

	</div>
</aside>
