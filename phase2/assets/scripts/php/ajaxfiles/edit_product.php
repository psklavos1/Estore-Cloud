<?php

session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';
include '../helper_scripts/connection_mongo.php';
$user_data = check_login($con);
$user_id = $user_data['ID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // data
    $product_id = new MongoDB\BSON\ObjectId($_POST['product_id']);
    $name = $_POST['name'];
    $product_code = $_POST['product_code'];
    $date = $_POST['date_of_withdrawal'];
    $category = $_POST['category'];
    $price = floatval($_POST['price']);

    // New
    $db = $dbClient->estore;
    $collection = $db->products;
 
    $updateResult = $collection->updateOne(
        [ '_id' => $product_id ],
        [ '$set' => [ 'name' => $name, 'productcode'=>$product_code, 'dateofwithdrawal'=>$date, 'category'=> $category, 'price'=>$price ]]
    );
    $mod_count = $updateResult->getModifiedCount();
    if ($mod_count > 0)
        echo 0;
    else echo -1;
}

?>
