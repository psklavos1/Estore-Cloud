<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-With:');

include_once '../../models/User.php';

// Get raw posted data
$data =json_decode(file_get_contents('php://input'), true);
$token = $data['xtoken'];


// Instantiate objs
$user_obj = new User($token);

// Update Product
if($user_obj->updateUser($data['id'],$data['username'],$data['email'],$data['role'],$data['description'],$data['website'])){
    echo json_encode(array("message" => "SUCCESS"));
}
else echo json_encode(array("message" => "ERROR"));