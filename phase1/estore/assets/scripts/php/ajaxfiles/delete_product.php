<?php
session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $del_id = $_POST['del_id'];

    // Delete a given product
    $query = "DELETE FROM PRODUCTS WHERE ID = '$del_id'";
    $res = mysqli_query($con, $query);

    if ($res) {
        echo 0;
    }
    else
        echo "Error";
}

?>
