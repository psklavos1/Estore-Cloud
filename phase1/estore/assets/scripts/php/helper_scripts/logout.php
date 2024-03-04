<?php
    session_start();
    // Php to logout from account and deprive User privileges
    if(isset($_SESSION['loggedin'])){
        unset($_SESSION['loggedin']);
        unset($_SESSION['username']);
    }
    header("Location: ../../../index.php");
    die;

?>