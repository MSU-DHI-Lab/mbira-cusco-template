<?php
/**
 * Created by PhpStorm.
 * User: ZhichengXu
 * Date: 4/7/16
 * Time: 4:25 PM
 */
require '../lib/site.php';

$login = true;

if(isset($_POST['user']) && isset($_POST['password'])) {
    $users = new Users($site);

    $user = $users->login($_POST['user'], $_POST['password']);
    if(!is_string($user)) {
        $_SESSION['user'] = $user;
        unset($_SESSION['login-error']);
        header("location: ../");
        exit;
    } else {
        $_SESSION['login-error'] = $user;
    }
}

header("location: ../login.php");