<?php
ob_start();		 // ensures anything dumped out will be caught
require 'lib/site.php';
include 'app/inc/head.php';
include 'app/inc/left-sidebar.php';
// include 'lib/site.php';
$login = false;

require_once "lib/site.php";

unset($_SESSION['search-error']);

$response = $search->newSearch(
    strip_tags($_POST['query'])
  );

if(isset($response["errors"])) {
    $_SESSION['search-error'] = $response;
    header("location: index.php");
}



?>

<div class="main">
  <div>
  	<div class="title">
  		<div class="container">
  			<h1>Locations</h1>
  		</div>
  	</div>

  	<!-- contains all exhibit tiles -->

  	<div class="tiles">

  		<?php

  			for ($x = 0; $x < count($response['locations']); $x++) {
  				echo '
  					<a href="location.php?id='.$response['locations'][$x]['id'].'">
  						<div class="tile">
  							<img src="'.$source.$response['locations'][$x]['thumb_path'].'" alt="">
  							<span class="tile-name">
  								<p>'.$response['locations'][$x]['name'].'</p>
  							</span>
  						</div>
  					</a>
  				';
  			}

        if (count($response['locations']) == 0) {
          echo "<p class='search-not-found'>No locations match the query.</p>";
        }

  		?>

  	</div>
  </div>
</div>

<div class="main">
  <div>
    <div class="title">
      <div class="container">
        <h1>Areas</h1>
      </div>
    </div>

    <!-- contains all exhibit tiles -->

    <div class="tiles">

      <?php

        for ($x = 0; $x < count($response['areas']); $x++) {
          echo '
            <a href="area.php?id='.$response['areas'][$x]['id'].'">
              <div class="tile">
                <img src="'.$source.$response['areas'][$x]['thumb_path'].'" alt="">
                <span class="tile-name">
                  <p>'.$response['areas'][$x]['name'].'</p>
                </span>
              </div>
            </a>
          ';
        }

        if (count($response['areas']) == 0) {
          echo "<p class='search-not-found'>No areas match the query.</p>";
        }

      ?>

    </div>
  </div>
</div>

<div class="main">
  <div>
    <div class="title">
      <div class="container">
        <h1>Exhibits</h1>
      </div>
    </div>

    <!-- contains all exhibit tiles -->

    <div class="tiles">

      <?php

        for ($x = 0; $x < count($response['exhibits']); $x++) {
          echo '
            <a href="exhibit.php?id='.$response['exhibits'][$x]['id'].'">
              <div class="tile">
                <img src="'.$source.$response['exhibits'][$x]['thumb_path'].'" alt="">
                <span class="tile-name">
                  <p>'.$response['exhibits'][$x]['name'].'</p>
                </span>
              </div>
            </a>
          ';
        }

        if (count($response['exhibits']) == 0) {
          echo "<p class='search-not-found'>No exhibits match the query.</p>";
        }

      ?>

    </div>
  </div>
</div>

<div class="main">
  <div>
    <div class="title">
      <div class="container">
        <h1>Explorations</h1>
      </div>
    </div>

    <!-- contains all exhibit tiles -->

    <div class="tiles">

      <?php

        for ($x = 0; $x < count($response['explorations']); $x++) {
          echo '
            <a href="exploration.php?id='.$response['explorations'][$x]['id'].'">
              <div class="tile">
                <img src="'.$source.$response['explorations'][$x]['thumb_path'].'" alt="">
                <span class="tile-name">
                  <p>'.$response['explorations'][$x]['name'].'</p>
                </span>
              </div>
            </a>
          ';
        }

        if (count($response['explorations']) == 0) {
          echo "<p class='search-not-found'>No explorations match the query.</p>";
        }

      ?>

    </div>
  </div>
</div>

<?php
	include 'app/inc/footer.php';
?>
