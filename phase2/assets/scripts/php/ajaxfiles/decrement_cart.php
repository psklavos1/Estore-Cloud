<?php
session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';
include '../helper_scripts/connection_mongo.php';
$user_data = check_login($con);
$user_id = intval($user_data['ID']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // data
    $product_id = new MongoDB\BSON\ObjectId($_POST['id']);
    // New
    $db = $dbClient->estore;
    $collection = $db->carts;

    $filter = ['userid' => $user_id, 'productid' => $product_id];
    $options = ['sort'=>['dateofinsertion' => 1]]; 
    $deleteResult = $collection->findOneAndDelete($filter,$options); 

    if($deleteResult){
        echo 0;
    }else echo "Error";
}
?>
