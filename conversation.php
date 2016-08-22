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
		$convo = $_GET['convo'];
		$type = $_GET['type'];

        $sql ="SELECT id, user_id, location_id, replyTo, isPending, UNIX_TIMESTAMP(created_at), deleted, comment FROM mbira_location_comments WHERE location_id=:location AND (id=:id OR replyTo=:reply)";

        $pdo = new PDO("mysql:dbname=$dbname;host=$dbhost;charset=utf8", $dbuser, $dbpass);
        $statement = $pdo->prepare($sql);
        $statement->execute(array('location' => $id, 'id' => $convo, 'reply' => $convo));
        if($statement->rowCount() === 0) {
            // return null;
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
		$comments[0]['replies'] = array_reverse($comments[0]['replies']);

	}else {
		header('Location: ./index.php'); 		///< go to homepage if the id is unknown
	}
?>

<div class="main">

	<!-- returns to single location page -->

	<div class="return-location">
		<a href=<?php echo "location.php?id=".$id ?>>
			<span class="overlay">
				<div class="container header">
					<img class="icon" src="app/styles/icons/arrow-left.svg" />
					<p>Location</p>
				</div>
			</span>
		</a>
	</div>

	<div class="title">
		<div class="container title-with-backButton">
			<h1 class="convo-page-title">Conversation</h1>
		</div>
	</div>

	<!-- contains all conversations -->
	<!-- this container is necessary in order for project nav to look proper on this page only -->

	<div class="convo-contents">

		<!-- single conversation -->

		<div id="single-conversation">

			<!-- the chosen conversation from the conversations page -->

	<?php
		$html = <<<HTMLL
			<div class="main-convo">
				<div class="container">

					<!-- user badges will depend on each user -->
					<!-- temporarily uses location icon until actual SVG icons can be made -->

					<div class="badges">
						<img class="icon" src="app/styles/icons/badge-projectPerson.svg" />
					</div>

					<h2>
HTMLL;
		$html .= $comments[0]['deleted'] == 'yes' ? 'Removed' : $comments[0]['user'];
		$html .= <<<HTMLL
					</h2>
					<h4 class="since-post">
HTMLL;
		$html .= time_elapsed_string($comments[0]['date']);

		$html .= <<< HTMLL
					</h4>

					<p class="post-preview">
HTMLL;
		$html .= $comments[0]['deleted'] == 'yes' ? 'This comment has been removed by an admin.' : $comments[0]['comment'];

		$html .= <<< HTMLL
					</p>

				</div>
			</div>

HTMLL;
	echo $html;

?>		

	<?php
		$html_final = "";
		$html = "";
		for ($i=0; $i < count($comments[0]['replies']); $i++) { 
		$html = <<<HTMLL
			<div class="reply">
				<div class="container">

					<div class="badges">
						<img class="icon" src="app/styles/icons/badge-citizenExpert.svg" />
						<img class="icon" src="app/styles/icons/badge-projectExpert.svg" />
						<img class="icon" src="app/styles/icons/badge-projectPerson.svg" />
					</div>

					<h2>
HTMLL;
		$html .= $comments[0]['replies'][$i]['deleted'] == 'yes' ? 'Removed' : $comments[0]['replies'][$i]['user'];
		$html .= <<<HTMLL
					</h2>
					<h4 class="since-post">
HTMLL;
		$html .= time_elapsed_string($comments[0]['replies'][$i]['date']);

		$html .= <<< HTMLL
					</h4>

					<p class="post-preview">
HTMLL;
		$html .= $comments[0]['replies'][$i]['deleted'] == 'yes' ? 'This comment has been removed by an admin.' : $comments[0]['replies'][$i]['comment'];

		$html .= <<< HTMLL
					</p>

				</div>
			</div>

HTMLL;
		$html_final .= $html;
	}
	echo $html_final;

?>		

		</div>

		<!-- this project nav needs the above "convo-contents" div in order to work properly -->

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

			<a href="conversations.php?id=<?php echo $id ?>&type=<?php echo $_GET['type'] ?>" class="nav-item">
				<img src="app/styles/icons/discussions.svg" />
				<p><span>Back to Conversations</span></p>
			</a>

			<a href="<?php echo (!isset($_SESSION['user']) ? 'login.php' : '#') ?>" class="nav-item reply-now">
				<img src="app/styles/icons/info.svg" />
				<p><span>Contribute to Conversation</span></p>
			</a>

			<a href="location.php?id=<?php echo $id ?>" class="nav-item">
				<img src="app/styles/icons/arrow-left.svg" />
				<p><span>Back to location</span></p>
			</a>

		</div>

	</div>

</div>

<!-- hidden overlay that will show when user clicks "Reply to Conversation" in project nav menu -->

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
			<form id="contributeForm" action="post/conversation-comment-post.php" method="post">
				<textarea class="convo-textbox" rows="1" name="comment" placeholder="YOUR CONVERSATION"></textarea>
				<input type="hidden" name="user" value="<?php echo $user->getId() ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="hidden" name="convo_id" value="<?php echo $convo ?>">
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

	$( '.reply-now' ).click(function(e) {
		e.preventDefault(); 
		console.log("sdf");
		<?php if(isset($_SESSION['user'])) { ?>

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
