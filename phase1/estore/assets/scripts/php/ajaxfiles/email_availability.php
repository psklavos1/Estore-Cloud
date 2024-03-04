<?php
session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

if(isset($_POST['email'])){
    
    $email = $_POST['email'];
    $query = "SELECT * FROM users WHERE EMAIL ='$email' limit 1";

    $res = mysqli_query($con, $query);
    // If it is valid
    if ($res && mysqli_num_rows($res) > 0) 
        echo "Email already connected to other account";
    exit;
}
?>
