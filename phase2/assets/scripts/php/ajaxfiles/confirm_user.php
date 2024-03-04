<?php
session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if valid
    // print_r($_POST);
    $user_id = $_POST['id'];
    // echo $user_id;

    $query = "UPDATE users
    SET CONFIRMED = 1
    WHERE ID = $user_id;";
    $res = mysqli_query($con, $query);

    if ($res) {
        echo 0;
    }else
        echo -1;
}

?>
