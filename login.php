<?php
    require 'lib/site.php';
    include 'app/inc/head.php';
    include 'app/inc/left-sidebar.php';

    if (isset($_SESSION['login-error'])) {
        $msg = $_SESSION['login-error'];
        unset($_SESSION['login-error']);
    } else {
        $msg = '';
    }
    $loginForm = <<<HTML
<h1 id="loginHeader">Sign In</h1>

<form id="loginForm" action="post/login-post.php" method="post">
    <p>$msg</p>
    <input name="user" placeholder="Username or Email" autofocus /><br/>
    <input type="password" name="password" placeholder="Password" /><br/>

    <input type="submit" value="Sign In">

    <p><a href="signup.php">Create Account</a></p>
    <p><a href="newpasswordrequest.php">Forgot Password?</a></p>
</form>
HTML;

    $logoutForm = <<<HTML
<h1 id="loginHeader">Logged In</h1>

<form id="loginForm" action="logout.php" method="post">
    <p>You're already logged in, click the button below to logout.</p>
    <input type="submit" value="Log Out">
</form>
HTML;

    if(isset($_SESSION['user'])) {
        echo $logoutForm;
    } else {
        echo $loginForm;
    }

?>





<?php
	include 'app/inc/footer.php';
?>
