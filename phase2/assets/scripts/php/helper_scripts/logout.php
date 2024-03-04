<?php
    session_start();
    // Php to logout from account and deprive User privileges
    if(isset($_SESSION['token'])){
        unset($_SESSION['token']);
        unset($_SESSION['xtoken']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['id']);
        unset($_SESSION['role']);
    }
    header("Location: ../../../index.php");
    die;

?>