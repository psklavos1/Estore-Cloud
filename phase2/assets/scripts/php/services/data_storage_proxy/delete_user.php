<?php
session_start();
// data 
$token = $_SESSION["token"];
$xtoken = $_SESSION["xtoken"];

$proxy = "data-storage-proxy";
$port = "3020";
$user_id = $_POST['del_id'];

$data = json_encode(array('user_id'=> $user_id, 'xtoken' =>$xtoken));
$curl = curl_init("http://".$proxy.":".$port."/api/user/delete.php");
curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'X-Auth-Token: '.$token.''
));

$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response,false);

if($result->message == "SUCCESS")
    echo 0;
else echo -1;


?>
