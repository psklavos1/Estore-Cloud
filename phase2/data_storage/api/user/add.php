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
$user_id = $data['user_id'];
$token = $data['xtoken'];

// Instantiate objs
$user_obj = new User($token);

// Functionality 
if($user_obj->addUser($user_id)){
    echo json_encode(array("message" => "SUCCESS"));
}
else echo json_encode(array("message" => "ERROR"));

?>