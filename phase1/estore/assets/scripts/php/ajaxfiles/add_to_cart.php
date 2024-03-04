<?php

session_start();
include '../helper_scripts/connection.php';
include '../helper_scripts/functions.php';

$user_data = check_login($con);
$user_id = $user_data['ID'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $product_id = $_POST['id'];
    // Generate a Datetime in the wanted format
    date_default_timezone_set('Europe/Athens');
    $datetime = date("Y-m-d H:i:s");
    $query = "INSERT INTO carts(USERID, PRODUCTID, DATEOFINSERTION) 
    VALUES('$user_id', '$product_id', '$datetime')";
    $res = mysqli_query($con, $query);

    // return either the newly inserted id or error message
    if ($res) {
        $last_id = $con->insert_id;
        echo $last_id;
    } else {
        echo 'Error';
    }
}

?>
