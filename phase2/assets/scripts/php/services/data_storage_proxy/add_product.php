<?php
session_start();

// data 
$token = $_SESSION["token"];
$proxy = "data-storage-proxy";
$port = "3020";
$username = $_SESSION['username'];
$data = json_encode(array('username'=>$username,'name' => $_POST['name'],
'product_code' => $_POST['product_code'],'price' => floatval($_POST['price']),
'date_of_withdrawal' => $_POST['date_of_withdrawal'],
'category' => $_POST['category'], 'available' => $_POST['available'] ));

$curl = curl_init("http://".$proxy.":".$port."/api/product/add.php");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "X-Auth-token: ".$token.""
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>