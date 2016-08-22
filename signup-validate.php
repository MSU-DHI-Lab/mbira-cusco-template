<?php
/**
 * Created by PhpStorm.
 * User: ZhichengXu
 * Date: 5/16/16
 * Time: 5:19 PM
 */

$login = false;
require_once "lib/site.php";

$controller = new ValidationController($site);
$msg = $controller->validate($_GET['v']);

header("location: login.php");
exit;