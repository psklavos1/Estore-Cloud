<?php

session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';
include '../helper_scripts/connection_mongo.php';
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

    // New
    $db = $dbClient->estore;
    $collection = $db->products;

    $document = ['_id' => new MongoDB\BSON\ObjectId(), 'name' => $name, "productcode" => $product_code, "price" => intval($price),
    "dateofwithdrawal" => $date_of_withdrawal, "category" => $category, "sellername" => $seller_name];
    try {
        $insertOneResult = $collection->insertOne($document);
    } catch (Exception $e) {
        echo "Error";
    }
    echo (string)$insertOneResult->getInsertedId();
    
}

?>
