<?php

session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';
include '../helper_scripts/connection_mongo.php';
$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //data
    $product_id = $_POST['id'];
    $user_id = $user_data['ID'];
    // Generate a Datetime in the wanted format
    date_default_timezone_set('Europe/Athens');
    $datetime = date("Y-m-d H:i:s");

    // Add to db
    $db = $dbClient->estore;
    $collection = $db->carts;
    $document = ['_id' => new MongoDB\BSON\ObjectId(), 'userid' => intval($user_id), 'productid' => new MongoDB\BSON\ObjectId($product_id), 
    'dateofinsertion' => $datetime];
    try {
        $insertOneResult = $collection->insertOne($document);
    } catch (Exception $e) {
        echo "Error";
    }
    // mylog((string)$insertOneResult->getInsertedId());
    echo (string)$insertOneResult->getInsertedId();
}
?>
