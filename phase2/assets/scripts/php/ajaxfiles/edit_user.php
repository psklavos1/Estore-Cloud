<?php

session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
$user_id = $user_data['ID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // data
    $update_id = $_POST['update_id'];

    // cannot delete myself
    if ($user_id == $update_id) {
        echo "Error: Cannot update current user data";
        return;
    }

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    $query = "UPDATE users SET NAME = '$name', SURNAME = '$surname', USERNAME = '$username', EMAIL = '$email', ROLE='$role' WHERE ID='$update_id'";
    $res = mysqli_query($con, $query);

    if ($res) {
        echo 0;
    } else {
        echo "Error: Cannot update user data";
    }
}

?>
