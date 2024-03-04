<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-With:');
include_once '../../models/User.php';

// data
// Get raw posted data
$data =json_decode(file_get_contents('php://input'), true);
$token = $data['token'];

// Instantiate objs
$user_obj = new User($token);

// Functionality 
$users = array();
array_push($users,$user_obj->getUserInfo());

// Get row count
$noRows = 0;
$noRows = count($users);
// Check if Users
if($noRows > 0) {
  // Turn to JSON 
  echo json_encode($users);
} else {
  // No users
  echo json_encode(
    array('message' => 'No Users Found')
  );
}
?>