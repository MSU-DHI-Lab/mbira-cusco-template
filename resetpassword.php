<?php
  if (!isset($_GET['v'])) {
    header("location: index.php");
    exit;
  }

  include 'lib/site.php';
  include 'app/inc/head.php';
  include 'app/inc/left-sidebar.php';

  $controller = new ValidationController($site);
  $user = $controller->validate($_GET['v']);

  if ($user == "Invalid validator") {
    header("location: index.php");
    exit;
  }
?>


<h1 id="signupHeader">Reset Password</h1>

<form id="signupForm" action="post/resetpassword-post.php" method="post">
    <?php
    if(isset($_SESSION['newpass-error'])) {
        echo "<p>" . $_SESSION['newpass-error'] . "</p>";
        unset($_SESSION['newpass-error']);
    }
    ?>
    <input type="email" name="email" value="<?php echo $user['email'] ?>" disabled /><br/>
    <input type="hidden" name="v" value="<?php echo $_GET['v'] ?>" />
    <input type="password" name="password" placeholder="New Password" /><br/>
    <input type="password" name="repeatPassword" placeholder="Repeat Password" /><br/>

    <input type="submit" value="Submit">


</form>


<?php
    include 'app/inc/footer.php';
?>
