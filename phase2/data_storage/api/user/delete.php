<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-With:');

include_once '../../models/User.php';


// Get data
$data =json_decode(file_get_contents('php://input'), true);
$user_id = $data['user_id'];
$xtoken = $data['xtoken'];

// Instantiate objs
$user_obj = new User($xtoken);
// Delete product
if ($user_obj->deleteUser($user_id)) {
    echo json_encode(
    array('message' => 'SUCCESS')
    );
} else {
echo json_encode(
    array('message' => 'ERROR')
);
}
