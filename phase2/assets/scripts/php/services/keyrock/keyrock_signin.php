<?php

include '../../helper_scripts/parse.php';

if (isset($_POST["loginAction"])) {

  if ($_POST['loginAction'] == 'login'){
  	// get data coming from an HTML form  
    $email = $_POST['email'];
    $password = $_POST['password'];

    /************************** ACQUIRE X-AUTH-TOKEN WITH ADMIN DATA **************************/
    // Curl post request.
    // create curl resource 
    $ch = curl_init();
    // set url 
    curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/auth/tokens");
    // Set the method
    curl_setopt($ch, CURLOPT_POST, TRUE);
    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    // include header in output
    curl_setopt($ch, CURLOPT_HEADER, 1);
    // Set the post fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{
      \"name\": \"admin@test.com\",
      \"password\": \"1234\"
    }");
    // execute and return the headers in array
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json"
    ));
    // post response
    $response = curl_exec($ch);

    // check_valid_response($response,$ch, "Error: Request X-AUTH-TOKEN");
  
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    curl_close($ch);
    
    // To do extract data from header
    $data = headersParseArray($header);
    // Extract X-AUTH-TOKEN
    $xtoken = $data['X-Subject-Token'];
    /********************************** AUTHENTICATE USER AND GENERATE TOKEN ****************************/
    
    // To do for each client 
    $client_id = "dc7c8057-6cc5-40f9-92b9-ec7ef20e284c";
    $client_secret = "82349928-066d-4e81-98b1-c94d7a7297c0";
    
    $curl = curl_init();
    $base_64 = base64_encode($client_id.":".$client_secret);
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://keyrock:3005/oauth2/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded",
        "Authorization: Basic ". $base_64.""
      ),
      CURLOPT_POSTFIELDS =>'grant_type=password&username='.$email.'&password='.$password.'',
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $result1 = json_decode($response);
    
    if ( $result1 != "Invalid grant: user credentials are invalid") {

      /************************ACQUIRE USERNAME********************************/
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
          "X-Auth-Token: ".$xtoken.""
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      //echo $response;
      $result = json_decode($response, true);

      foreach($result as $key){
        foreach($key as $doc){

          if($doc['email'] == $email){
            $userid = $doc['id'];
            $username = $doc['username'];
          }
        }
      }

      /***************************ACQUIRE ROLE ***************************/

      $appID =            "dc7c8057-6cc5-40f9-92b9-ec7ef20e284c";
      $roleUserID =       "ce55c887-6ce9-422a-bb55-27c3ab38456f";
      $roleSellerID =     "641e26e5-0063-44ff-991a-47bc50f4f377";
      $roleAdminID =      "d8404574-8bbd-4096-916f-9a2f4ab0583a";

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, "http://keyrock:3005/v1/applications/".$appID."/users/".$userid."/roles");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "X-Auth-token: ".$xtoken.""
      ));
      $response = curl_exec($ch);

      curl_close($ch);
      $result = json_decode($response, true);
      
      foreach($result as $key){
        foreach($key as $doc){
          $role = $doc['role_id'];
        }
      }


      if ($role == $roleUserID) {
        $role = "User";
      }
      elseif ($role == $roleSellerID) {
        $role = "Seller";
      }
      else{ // Providers also will be treated as Admins
        $role = "Admin";
      }
      
      session_start();
      $_SESSION["token"] = $result1->access_token;

      $_SESSION["xtoken"] = $xtoken;

      $_SESSION["id"] = $userid;
      $_SESSION["username"] = $username;
      $_SESSION["email"] = $email;
      $_SESSION["role"] = $role;

      echo 'Logged In Successfully'; // echo the response message you want for success
    }
    else {
      echo 'Error Logging In. Please Try Again'; // echo the response message you want for error 
    }

  }
}

?>