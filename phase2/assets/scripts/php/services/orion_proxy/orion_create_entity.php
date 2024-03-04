<?php

session_start();
$oath2token = $_SESSION["token"]; // get oauth2token from session variable

// get data coming from an HTML form  
$name = $_POST['name'];
$product_code = $_POST['product_code'];
$price = $_POST['price'];
$category = $_POST['category'];
$seller_name = $_SESSION['username'];
$date_of_withdrawal = $_POST['date_of_withdrawal'];
$id = $_POST['id'];
$available = $_POST['available'];
date_default_timezone_set('Europe/Athens');
$datetime = DateTime::createFromFormat("Y-m-d", $date_of_withdrawal);;

// Curl Request to add an entity
$curl = curl_init();

// set the POST request body and parameters
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://orion-proxy:1027/v2/entities', // use orion-proxy (PEP Proxy for Orion CB) IP address and port instead of Orion CB's 
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "id": "'.$id.'",
    "type": "Product",
    "product": {
        "value": "'.$name.'",
        "type": "text"
    },
    "productcode": {
        "value": "'.$product_code.'",
        "type": "text"
    },
    "price": {
        "value": '.$price.',
        "type": "Float"
    },
    "available": {
      "value": '.$available.',
      "type": "Integer"
    },
    "category": {
        "value": "'.$category.'",
        "type": "text"
    },
    "sellername": {
        "value": "'.$seller_name.'",
        "type": "text"
    },
    "dateExpires": {
      "value": "'.$datetime->format(DateTime::ATOM).'",
      "type": "DateTime"
    }  
  }',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'X-Auth-Token: '.$oath2token.'',
    'Accept: application/json'
  ),
));

$response = curl_exec($curl); // send request and get response 
curl_close($curl);
echo $response; 

?>
