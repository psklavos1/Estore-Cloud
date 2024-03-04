<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-With:');

include_once '../../config/Database.php';
include_once '../../models/Cart.php';
include_once '../../models/Product.php';


// Instantialise DB & connect
$conn = new Database();
$db = $conn->connect();


// Instantiate objs
$cart_obj = new Cart($db);
$product_obj = new Product($db);
// Get data
$data =json_decode(file_get_contents('php://input'), true);
$user_id = $data['user_id'];
$product_id = $data['product_id'];

// Delete cart
$many = $cart_obj->deleteCart($user_id,$product_id);
if ($many && $many > 0) {
    $product_obj->incrementAvailableMany($product_id,$many);
    echo json_encode(
    array('message' => 'SUCCESS')
);
} else {
echo json_encode(
    array('message' => 'ERROR')
);
}