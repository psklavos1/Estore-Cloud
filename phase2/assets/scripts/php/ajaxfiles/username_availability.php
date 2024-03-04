<?php
session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';

if(isset($_POST['user_name'])){
    $username = $_POST['user_name'];
    $query = "SELECT * FROM users WHERE USERNAME ='$username' limit 1";

    $res = mysqli_query($con, $query);
    // If already exists
    if ($res && mysqli_num_rows($res) > 0) 
        echo "Username already in use";
    
    exit;
}


?>