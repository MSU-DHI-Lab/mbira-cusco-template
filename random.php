<?php
ob_start();

require "lib/site.php";

$area_id = $areas->get_random();        ///< get a random area id

$location_id = $locations->get_random();    ///< get a random location id

$links = array();       ///< stores area and location links

// if both ids are set, choose one randomly
if (isset($area_id) and isset($location_id)) {
    array_push($links, 'Location: area.php?id='.$area_id);
    array_push($links, 'Location: location.php?id='.$location_id);
    $destination = $links[array_rand($links, 1)];
    header($destination);
}

// if location id is null, go to area
if (isset($area_id) and is_null($location_id)) {
    header('Location: area.php?id='.$area_id);
}

// if area id is null, go to location
if (is_null($area_id) and isset($location_id)) {
    header('Location: location.php?id='.$location_id);
}

// if both area null, go to error page
if (is_null($area_id) and is_null($location_id)) {
    header('Location: exhibit-error.php');
}