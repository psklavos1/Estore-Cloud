<?php
session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';
include '../helper_scripts/connection_mongo.php';
$user_data = check_login($con);
$user_id = intval($user_data['ID']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // data
    $product_id = new MongoDB\BSON\ObjectId($_POST['product_id']);
    // New
    $db = $dbClient->estore;
    $collection = $db->carts;

    $filter = ['userid' => $user_id, 'productid' => $product_id];
    $deleteResult = $collection->deleteMany($filter); 

    if($deleteResult->getDeletedCount()>0){
        echo 0;
    }else echo "Error";
}

?>
