<?php
session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
$user_id = $user_data['ID'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $del_id = $_POST['del_id'];

    // cannot delete myself
    if ($del_id == $user_id) {
        echo "Error: Cannot commit self delete";
        return;
    }

    $query = "DELETE FROM users WHERE ID = '$del_id'";
    $res = mysqli_query($con, $query);

    if ($res) {
        echo 0;
    }
    else{
        echo "The user not found to delete";
    }
}

?>
