<?php

session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
$user_id = $user_data['ID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // data
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $product_code = $_POST['product_code'];
    $date = $_POST['date_of_withdrawal'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Update all the fields
    $query = "UPDATE PRODUCTS SET NAME = '$name', PRODUCTCODE = '$product_code', DATEOFWITHDRAWAL = '$date', CATEGORY = '$category', price = '$price' WHERE ID='$product_id'";
    $res = mysqli_query($con, $query);

    if ($res) {
        echo 0;
    } else {
        echo -1;
    }
}

?>
