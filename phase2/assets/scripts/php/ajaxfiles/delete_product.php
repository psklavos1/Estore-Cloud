<?php
session_start();
include '../helper_scripts/connection_mysql.php';
include '../helper_scripts/functions.php';
include '../helper_scripts/connection_mongo.php';
$user_data = check_login($con);
$user_id = $user_data['ID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // New
    $db = $dbClient->estore;
    $collection = $db->products;
    $del_id = new MongoDB\BSON\ObjectId($_POST['del_id']);

    $filter = ['_id' => $del_id];
    try {
        $deleteResult = $collection->deleteOne($filter);
    } catch (Exception $e) {
        echo "Error";
    }
    if($deleteResult->getDeletedCount() == 0) echo "Error";
    else echo 0;
}

?>
