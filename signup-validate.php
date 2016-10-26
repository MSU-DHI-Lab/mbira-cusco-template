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
$user = $controller->validate($_GET['v']);

if ($user == "Invalid validator") {
  $_SESSION['login-error'] = $user;
  header("location: login.php");
  exit;
} else {
  $_SESSION['user'] = $user;
  unset($_SESSION['login-error']);
}

header("location: index.php");
exit;
