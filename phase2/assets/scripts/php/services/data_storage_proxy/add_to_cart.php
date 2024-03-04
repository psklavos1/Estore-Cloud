<?php
session_start();

// data 
$token = $_SESSION["token"];
$proxy = "data-storage-proxy";
$port = "3020";
$user_id = $_SESSION['id'];
$product_id = $_POST['id'];
// Generate a Datetime in the wanted format
date_default_timezone_set('Europe/Athens');
$datetime = date("Y-m-d H:i:s");
$data = json_encode(array('user_id'=>$user_id, 'product_id'=> $product_id, 'datetime'=> $datetime));

$curl = curl_init("http://".$proxy.":".$port."/api/cart/add.php");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "X-Auth-token: ".$token.""
));

$response = curl_exec($curl);
curl_close($curl);
echo $response;

?>