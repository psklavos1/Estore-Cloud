<?php
include '../../helper_scripts/parse.php';

// get data coming from an HTML form 
$name = $_POST['name'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$role = $_POST['role'];


/***************** ACQUIRE X-Auth-Token *****************/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/auth/tokens");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"name\": \"admin@test.com\",
  \"password\": \"1234\"
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json"
));

$response = curl_exec($ch);  
 
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);

curl_close($ch);

$data = headersParseArray($header);
$xtoken = $data['X-Subject-Token'];
/********************** CREATE USER *********************/

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/users");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_POST, TRUE);

// \"name\": \"".$name."\",
//     \"surname\": \"".$surname."\",
//     \"role\": \"".$role."\",
    
curl_setopt($ch, CURLOPT_POSTFIELDS,"{
    \"user\": {
    \"username\": \"".$username."\",
    \"email\": \"".$email."\",
    \"password\": \"".$password."\"
  }
}");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "X-Auth-token: ".$xtoken.""
));

$response = curl_exec($ch);

// Error Check
$dec_response = json_decode($response, false);
if(isset( $dec_response->error )){
  if($dec_response->error->message == "Email already used"){
    echo "Email already used";
  }
  else{
    echo "Error Creating Account";
  }
  die();
  curl_close($ch);
}

/******************** GET THE CREATED USER'S ID **********************/

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://keyrock:3005/v1/users',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    "X-Auth-token: ".$xtoken.""
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$result = json_decode($response, true);

$userid = "";
foreach($result as $key){
  foreach($key as $doc){
    if($doc['username'] == $username && $doc['email'] == $email){
      $userid = $doc['id'];
    }
  }
}
if($userid == ""){
  echo "Error New User Id";
  curl_close($ch);
  die();
}

/************************* User Update to be disabled at start ***********************/

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/users/".$userid."");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
// curl_setopt($ch, CURLOPT_HEADER, FALSE);

// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");

// curl_setopt($ch, CURLOPT_POSTFIELDS, "{
//   \"user\": {
//     \"enabled\": false
//   }
// }");


// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//   "Content-Type: application/json",
//   "X-Auth-token: ".$xtoken.""
// ));

// $response = curl_exec($ch);
// $error_msg="";
// if (curl_errno($ch)) {
//   $error_msg = curl_error($ch);
//   echo "Error Disable User";
//   curl_close($ch);
//   die();
// }
// curl_close($ch);


/************************* ASSIGN ROLE TO USER IN ORGANIZATION ***********************/
$appID =            "dc7c8057-6cc5-40f9-92b9-ec7ef20e284c";
$roleUserID =       "ce55c887-6ce9-422a-bb55-27c3ab38456f";
$roleSellerID =     "641e26e5-0063-44ff-991a-47bc50f4f377";
$roleAdminID =      "d8404574-8bbd-4096-916f-9a2f4ab0583a";
$orgEstoreUsers =   "71724de7-e4da-441b-85e3-f116450f319d";
$orgEstoreSellers = "77d79aa8-7b3e-4938-9680-0a5ae06cd59f";


$ch = curl_init();
if($role == "User"){
  curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/organizations/".$orgEstoreUsers."/users/".$userid."/organization_roles/member");
}
else if($role == "Seller"){
  curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/organizations/".$orgEstoreSellers."/users/".$userid."/organization_roles/member");
}
else{
  curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/organizations/".$orgEstoreSellers."/users/".$userid."/organization_roles/owner");
}
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Content-Type: application/json",
  "X-Auth-token: ".$xtoken.""
));

$response = curl_exec($ch);
if($role == "Admin"){
  curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/organizations/".$orgEstoreUsers."/users/".$userid."/organization_roles/owner");
  $response = curl_exec($ch);
}
$error_msg="";
if (curl_errno($ch)) {
  $error_msg = curl_error($ch);
  echo "Error Setting Role";
  curl_close($ch);
  die();
}

echo "Signed Up Successfully";
curl_close($ch);
die();

?>