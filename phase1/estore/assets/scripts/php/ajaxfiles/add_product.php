<?php

session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
$user_id = $user_data['ID'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // data
    $name = $_POST['name'];
    $product_code = $_POST['product_code'];
    $price = $_POST['price'];
    $date_of_withdrawal = $_POST['date_of_withdrawal'];
    $category = $_POST['category'];

    $seller_name = seller_name($con,$user_id);
    $query = "INSERT INTO products(NAME, PRODUCTCODE, PRICE, DATEOFWITHDRAWAL, CATEGORY, SELLERNAME,SELLERID) 
    VALUES('$name', '$product_code', '$price', '$date_of_withdrawal','$category','$seller_name', '$user_id')";
    $res = mysqli_query($con, $query);

    // Returns either the last_id or Error message
    if ($res) {
        $last_id = $con->insert_id;
        echo $last_id;
    } else {
        echo 'Error';
    }
}

?>
