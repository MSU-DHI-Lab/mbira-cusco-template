<?php
    include 'lib/site.php';
    include 'app/inc/head.php';
    include 'app/inc/left-sidebar.php';
?>


<h1 id="signupHeader">Create Account</h1>

<form id="signupForm" action="post/signup-post.php" method="post">
    <?php
    if(isset($_SESSION['newuser-error'])) {
        echo "<p>" . $_SESSION['newuser-error'] . "</p>";
        unset($_SESSION['newuser-error']);
    }
    ?>
    <input type="text" name="username" placeholder="Userame" autofocus /><br/>
    <input type="text" name="firstName" placeholder="First Name"/><br/>
    <input type="text" name="lastName" placeholder="Last Name" /><br/>
    <input type="email" name="email" placeholder="Email" /><br/>

    <input type="password" name="password" placeholder="Password" /><br/>
    <input type="password" name="repeatPassword" placeholder="Repeat Password" /><br/>

    <input type="submit" value="Create Account">

    <!-- "Sign Up With" section commented out, until an implementation has been decided upon
    <p>Or Sign Up With:</p>

    <p class="signUpIcon">
        <a href="#">
            <img src="app/styles/icons/temp/facebook.svg" width="7" height="14" alt="Sign Up with Facebook" />
        </a>
    </p>

    <p class="signUpIcon">
        <a href="#">
            <img src="app/styles/icons/temp/twitter.svg" width="14" height="11" alt="Sign Up with Twitter" />
        </a>
    </p>

    <p class="signUpIcon">
        <a href="#">
            <img src="app/styles/icons/temp/google-plus.svg" width="15" height="16" alt="Sign Up with Google+" />
        </a>
    </p>
    -->

</form>


<?php
    include 'app/inc/footer.php';
?>