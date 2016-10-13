<?php
    include 'lib/site.php';
    include 'app/inc/head.php';
    include 'app/inc/left-sidebar.php';
?>


<h1 id="signupHeader">Change Password Request</h1>

<form id="signupForm" action="post/newpasswordrequest-post.php" method="post">
  <?php
    if(isset($_SESSION['newpass-error'])) {
        echo "<p>" . $_SESSION['newpass-error'] . "</p>";
        unset($_SESSION['newpass-error']);
    }
  ?>
    <input type="email" name="email" placeholder="Email" autofocus/><br/>
    <input type="submit" value="Submit">
</form>


<?php
    include 'app/inc/footer.php';
?>
