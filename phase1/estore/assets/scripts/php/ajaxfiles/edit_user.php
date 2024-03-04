<?php

session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
$user_id = $user_data['ID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $user_id = $_POST['user_id'];
    
    $query = "UPDATE users SET NAME = '$name', SURNAME = '$surname', USERNAME = '$username', EMAIL = '$email', ROLE='$role' WHERE ID='$user_id'";
    $res = mysqli_query($con, $query);

    if ($res) {
        echo 0;
    } else {
        echo -1;
    }
}

?>
