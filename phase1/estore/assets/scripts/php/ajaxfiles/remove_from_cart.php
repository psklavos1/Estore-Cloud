<?php
session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
$user_id = $user_data['ID'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];

    $query = "DELETE FROM carts WHERE USERID = '$user_id' AND PRODUCTID = '$product_id'";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo 0;
    } else {
        echo -1;
    }
}

?>
