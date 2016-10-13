<?php
/**
 * Created by PhpStorm.
 * User: ZhichengXu
 * Date: 5/19/16
 * Time: 6:33 PM
 */

require 'lib/site.php';

$login = false;

unset($_SESSION['user']);
$_SESSION['login-error'] = "Successfully Logged Out.";

header("Location: login.php");
