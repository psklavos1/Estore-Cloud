<?php

session_start();
$oath2token = $_SESSION["token"]; // get oauth2token from session variable
// get data coming from an HTML form  
$seller_name = $_SESSION['username'];
$id = $_POST['id'];

$curl = curl_init();
// set the POST request body and parameters
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://orion-proxy:1027/v2/subscriptions/', 
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "description": "Update user on availability of a product",
    "subject": {
        "entities": [
            {
                "id": "'.$id.'",
                "type": "Product"
            }
        ],
        "condition": {
            "attrs": [
                "dateExpires",
                "available"
            ],
        "expression": {
            "q": "available==0"
        }
        }
    },
    "notification": {
        "http": {
            "url": "http://nefosservice-proxy:3020/api/orion/create.php"
        },
        "attrs": []
    },
    "expires": "2040-01-01T14:00:00.00Z",
    "throttling": 3
  }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'X-Auth-Token: '.$oath2token.'',
      'Accept: application/json'
    ),
  ));

$response = curl_exec($curl); // send request and get response
$result = json_decode($response,true);
if($response && array_key_exists('error',$result)){
    echo "Error Creating Subscription";
}else echo "Subscription Successful!"; 
curl_close($curl);

?>