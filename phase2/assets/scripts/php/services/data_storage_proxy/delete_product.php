<?php
session_start();
// data 
$token = $_SESSION["token"];
$proxy = "data-storage-proxy";
$port = "3020";
$product_id = $_POST['del_id'];

$data = json_encode(array('product_id'=> $product_id));
$curl = curl_init("http://".$proxy.":".$port."/api/product/delete.php");
curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'X-Auth-Token: '.$token.''
));

$response = curl_exec($curl);
curl_close($curl);

echo $response;

?>
