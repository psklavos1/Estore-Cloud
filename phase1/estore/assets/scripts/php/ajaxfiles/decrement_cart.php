<?php
session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
$user_id = $user_data['ID'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['id'];
    
    // Delete 1 appearance of the product in the user's cart and specifically the oldest
    $query = "DELETE FROM carts WHERE USERID = '$user_id' AND PRODUCTID = $product_id ORDER BY DATEOFINSERTION LIMIT 1";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo 0;
    } else {
        echo "Error";
    }
}
?>
