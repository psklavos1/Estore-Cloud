<?php
session_start();

// data 
$token = $_SESSION["token"];
$xtoken = $_SESSION['xtoken'];

$proxy = "data-storage-proxy";
$port = "3020";
$user_id = $_SESSION['id'];
$data = json_encode(array('id' => $_POST['update_id'], 'username' => $_POST['username'],
'email' => $_POST['email'],'role' =>$_POST['role'],
'description' => $_POST['description'],
'website' => $_POST['website'], 'xtoken' => $xtoken));

$curl = curl_init("http://".$proxy.":".$port."/api/user/update.php");
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