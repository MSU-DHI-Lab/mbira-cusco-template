<?php
    include 'lib/site.php';
    include 'app/inc/head.php';
    include 'app/inc/left-sidebar.php';
?>


<h1 id="signupHeader">Change Password</h1>

<form id="signupForm" action="post/newpassword-post.php" method="post">
    <?php
    if(isset($_SESSION['newuser-error'])) {
        echo "<p>" . $_SESSION['newuser-error'] . "</p>";
        unset($_SESSION['newuser-error']);
    }
    ?>
    <input type="email" name="email" placeholder="Email" autofocus/><br/>

    <input type="password" name="password" placeholder="New Password" /><br/>
    <input type="password" name="repeatPassword" placeholder="Repeat Password" /><br/>

    <input type="submit" value="Submit">


</form>


<?php
    include 'app/inc/footer.php';
?>