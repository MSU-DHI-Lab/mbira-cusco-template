<?php
	require 'lib/class/User.php';
	require 'lib/site.php';
	include 'app/inc/head.php';
	include 'app/inc/left-sidebar.php';

	$user;
	$usersName;

	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		$usersName = $user->getFirstName() . " " . $user->getLastName();
	}

	function time_elapsed_string($ptime) {

	    $etime = time() - $ptime;

	    if ($etime < 1)
	    {
	        return '0 seconds';
	    }

	    $a = array( 365 * 24 * 60 * 60  =>  'year',
	                 30 * 24 * 60 * 60  =>  'month',
	                      24 * 60 * 60  =>  'day',
	                           60 * 60  =>  'hour',
	                                60  =>  'minute',
	                                 1  =>  'second'
	                );
	    $a_plural = array( 'year'   => 'years',
	                       'month'  => 'months',
	                       'day'    => 'days',
	                       'hour'   => 'hours',
	                       'minute' => 'minutes',
	                       'second' => 'seconds'
	                );

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
	        }
	    }
	}

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$type = $_GET['type'];
		$table;

		if ($type == 'location') {
			$titleName = $locations->get($id)->getName();
			$type_php = 'location.php';
        	$sql =<<<SQL
SELECT id, user_id, location_id, replyTo, isPending, UNIX_TIMESTAMP(created_at), deleted, comment from mbira_location_comments
where location_id=?
SQL;
		} else if ($type == 'area') {
			$titleName = $areas->get($id)->getName();
			$type_php = 'area.php';
        	$sql =<<<SQL
SELECT id, user_id, area_id, replyTo, isPending, UNIX_TIMESTAMP(created_at), deleted, comment from mbira_area_comments
where area_id=?
SQL;
		}

        $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpass);
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
        }

		$comments = array();

        $sql2 =<<<SQL
SELECT firstName, lastName, email, id, username from mbira_users
SQL;

		$statement2 = $pdo->prepare($sql2);
        $statement2->execute();

		$userData = $statement2->fetchAll();

		function checkIfHasReply($i, $idToCheck, $data) {
			global $comments;

		    for ($j = 0; $j < count($data); $j++) {
		        if ($idToCheck == $data[$j]['replyTo']) {
		            $name = idToUser($data[$j]);
		            $tempObj = array(
		                "comment_id" => $data[$j]['id'],
		                "user" => $name,
		                "date" => $data[$j]['UNIX_TIMESTAMP(created_at)'],
		                "comment" => $data[$j]['comment'],

		                "replies" => array() ,
		                "pending" => $data[$j]['isPending'],
		                "deleted" => $data[$j]['deleted']
		            );
		            array_push($comments[$i]['replies'], $tempObj);
		        }
		    }
		}

		function idToUser($commentData) {
			global $userData;

		    for ($q = 0; $q < count($userData); $q++) {
		        if ($userData[$q]['id'] === $commentData['user_id']) {
		            return $userData[$q]['firstName'] . " " . $userData[$q]['lastName'];
		        }
		    }
		}

		function loadComments($data) {
			global $comments;
		    $comments = array();

		    usort($data, function ($x, $y) {
		        if ($x['replyTo'] - $y['replyTo'] === 0) {
		            return $y['UNIX_TIMESTAMP(created_at)'] - $x['UNIX_TIMESTAMP(created_at)'];
		        }
		        else {
		            return $y['replyTo'] - $x['replyTo'];
		        }
		    });

		    for ($i = 0; $i < count($data); $i++) {
		        if ($data[$i]['replyTo'] == 0 || $data[$i]['replyTo'] == null) {
		            $name = idToUser($data[$i]);
		            $tempObj = array(
		                "comment_id" => $data[$i]['id'],
		                "user" => $name,
		                "date" => $data[$i]['UNIX_TIMESTAMP(created_at)'],
		                "comment" => $data[$i]['comment'],

		                "replies" => array() ,
		                "pending" => $data[$i]['isPending'],
		                "deleted" => $data[$i]['deleted']
		            );
		            array_push($comments, $tempObj);
		        }
		    }

		    for ($i = 0; $i < count($comments); $i++) {
		        checkIfHasReply($i, $comments[$i]['comment_id'], $data);
		    }
		}

		$data = $statement->fetchAll();
		loadComments($data);
	}else {
		header('Location: ./index.php'); 		///< go to homepage if the id is unknown
	}
?>

<div class="main">
	<!-- returns to single location page -->

	<div class="return-location">
		<a href=<?php echo $type_php."?id=".$id ?> >
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p><?php echo $titleName; ?></p>
				</div>
			</span>
		</a>
	</div>

	<div class="title">
		<div class="container title-with-backButton">
			<h1 class="convo-page-title">Conversations</h1>
		</div>
	</div>

	<!-- this container is necessary in order for project nav to look proper on this page only -->

	<div class="convo-contents">

		<!-- contains all conversations -->

		<div id="conversations">

			<!-- single conversation -->
	<?php
		$html_final = "";
		for ($i=0; $i < count($comments); $i++) { 
			if ($comments[$i]['pending'] != 'yes') {
			$html = <<<HTMLL
				<div class="single-convo">
					<div class="container">

						<!-- user badges will depend on each user -->
						<!-- temporarily uses location icon until actual SVG icons can be made -->

						<div class="badges">
							<img class="icon" src="app/styles/icons/badge-citizenExpert.svg" />
							<img class="icon" src="app/styles/icons/badge-projectExpert.svg" />
							<img class="icon" src="app/styles/icons/badge-projectPerson.svg" />
						</div>

						<h2>
HTMLL;
			$html .= $comments[$i]['deleted'] == 'yes' ? 'Removed' : $comments[$i]['user'];
			$html .= <<<HTMLL
						</h2>
						<h4 class="since-post">
HTMLL;
			$html .= time_elapsed_string($comments[$i]['date']);

			$html .= <<< HTMLL
						</h4>

						<p class="post-preview">
HTMLL;
			$html .= $comments[$i]['deleted'] == 'yes' ? 'This comment has been removed by an admin.' : $comments[$i]['comment'];

			$html .= <<< HTMLL
						</p>

						<h4 class="reply-count">
HTMLL;
			$html .= count($comments[$i]['replies']);

			$html .= <<< HTMLL
						 replies</h4>

						<!-- directs user to conversation page with replies -->

						<div class="view-convo-btn">
							<a href="conversation.php?id=
HTMLL;
			$html .= $id . "&type=location&convo=" . $comments[$i]['comment_id'];

			$html .= <<< HTMLL
							">
								<p>View Conversation</p>
								<img class="icon" src="app/styles/icons/arrow-right.svg" />
							</a>
						</div>

					</div>
				</div>

HTMLL;
			$html_final .= $html;
			}
		}

	if (!$html_final) {
		echo "<div id='noconvo'>No Conversations Yet.</div>";
	} else {
		echo $html_final;
	}

?>

		</div>

		<div class="container project-nav show">

			<a href="location-map.php?id=<?php echo $id ?>"" class="nav-item">
				<img src="app/styles/icons/map.svg" />
				<p><span>View Map</span></p>
			</a>

			<a href="media.php?id=<?php echo $id ?>"" class="nav-item">
				<img src="app/styles/icons/media.svg" />
				<p><span>View media</span></p>
			</a>

			<a href="dig-deeper.php?id=<?php echo $id ?>"" class="nav-item">
				<img src="app/styles/icons/digdeeper.svg" />
				<p><span>Dig Deeper</span></p>
			</a>

			<a href="<?php echo (!isset($_SESSION['user']) ? 'login.php' : '#') ?>" class="nav-item reply-now">
				<img src="app/styles/icons/info.svg" />
				<p><span>Contribute</span></p>
			</a>

			<a href="location.php?id=<?php echo $id ?>" class="nav-item">
				<img src="app/styles/icons/arrow-left.svg" />
				<p><span>Back to location</span></p>
			</a>

		</div>

	</div>

</div>

<aside id="new-convo" class="hide">

	<div class="container">

		<span class="icon close"></span>

		<span class="expert-sign-in">
			<a href="#">
			</a>
		</span>

		<div class="contents">

			<input type="text" name="name" readonly value="<?php echo $usersName; ?>">

			<hr>
			<form id="contributeForm" action="post/conversation-post.php" method="post">
				<textarea class="convo-textbox" rows="1" name="convo" placeholder="YOUR CONVERSATION"></textarea>
				<input type="hidden" name="user" value="<?php echo $user->getId() ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="hidden" name="type" value="<?php echo $type ?>">
				<hr>

				<input type="submit" value="Submit">
			</form>

		</div>

	</div>

</aside>

<!-- uses elastic js api -->

<script src="app/scripts/vendors/elastic/elastic.js"></script>
<script>

	// init elastic js api to .convo-textbox textarea

	$( '.convo-textbox' ).elastic();

	// opens overlay when user clicks .reply-now

	$( '.reply-now' ).click(function() {
		<?php if ( isset($_SESSION['user']) ) { ?>

			$( '#new-convo' ).toggleClass( 'show' );

			// sets overlay to height of window

			var wrapH = $( '.wrap' ).height();

			$( '#new-convo' ).css('height', wrapH);

		<?php } ?>
	});

	// closes overlay

	$( '#new-convo .icon.close' ).click(function() {
		$( '#new-convo' ).removeClass( 'show' );
	});

</script>

<?php
	include 'app/inc/footer.php';
?>
