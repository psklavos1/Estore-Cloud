<?php

function tokenValid($token){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/auth/tokens");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "X-Auth-token: ".$token."",
    "X-Subject-token: ".$token.""
    ));

    $response = curl_exec($ch);
    $result = json_decode($response,true);
    curl_close($ch);
    if(array_key_exists('valid',$result) && $result['valid'] == true)
        return true;
    else{
        header('Location: ../error/invalid_token.php');
    }
}
