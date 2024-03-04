<?php
session_start();
$oath2token = $_SESSION["token"];

// get data coming from an HTML form  
$id = $_POST['id'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://orion-proxy:1027/v2/entities/".$id."?type=Product",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'DELETE',
  CURLOPT_HTTPHEADER => array(
    'Accept: application/json',
    'X-Auth-Token: '.$oath2token.''
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;