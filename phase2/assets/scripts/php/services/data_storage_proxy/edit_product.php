<?php
session_start();

// data 
$token = $_SESSION["token"];
$proxy = "data-storage-proxy";
$port = "3020";
$user_id = $_SESSION['id'];
$data = json_encode(array('id' => $_POST['product_id'], 'name' => $_POST['name'],
'product_code' => $_POST['product_code'],'price' => floatval($_POST['price']),
'date_of_withdrawal' => $_POST['date_of_withdrawal'],
'category' => $_POST['category'], 'available'=>$_POST['available'] ));

$curl = curl_init("http://".$proxy.":".$port."/api/product/update.php");
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "X-Auth-token: ".$token."",
    "Content-Type: application/json",
    'Content-Length: ' . strlen($data)
));

$response = curl_exec($curl);
curl_close($curl);

// See how to return.
echo $response;

?>