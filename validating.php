<?php

$login = false;
require_once "lib/site.php";
include 'app/inc/head.php';
include 'app/inc/left-sidebar.php';
?>

<form id="loginForm" action="#" method="post">

<h1 id="loginHeader">Validating</h1>
<p>
<?php
  echo $_SESSION['validating-text'];
  unset($_SESSION['validating-text']);
?></p>
<p><a href="login.php">Back to Login</a> </p>

</form>
