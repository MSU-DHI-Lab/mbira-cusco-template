<?php
ob_start();    // ensures anything dumped out will be caught
require 'lib/site.php';
include 'app/inc/head.php';
include 'app/inc/left-sidebar.php';
// include 'lib/site.php';
$login = false;

$locations_all = $locations->getAll();
$areas_all = $areas->getAll();
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

        for ($x = 0; $x < count($locations_all); $x++) {
          echo '
            <a href="location.php?id='.$locations_all[$x]['id'].'">
              <div class="tile">
                <img src="'.$source.$locations_all[$x]['thumb_path'].'" alt="">
                <span class="tile-name">
                  <p>'.$locations_all[$x]['name'].'</p>
                </span>
              </div>
            </a>
          ';
        }

        if (count($locations_all) == 0) {
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

        for ($x = 0; $x < count($areas_all); $x++) {
          echo '
            <a href="area.php?id='.$areas_all[$x]['id'].'">
              <div class="tile">
                <img src="'.$source.$areas_all[$x]['thumb_path'].'" alt="">
                <span class="tile-name">
                  <p>'.$areas_all[$x]['name'].'</p>
                </span>
              </div>
            </a>
          ';
        }

        if (count($areas_all) == 0) {
          echo "<p class='search-not-found'>No areas match the query.</p>";
        }

      ?>

    </div>
  </div>
</div>



<?php
  include 'app/inc/footer.php';
?>
