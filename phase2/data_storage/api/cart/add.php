<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-With:');

include_once '../../config/Database.php';
include_once '../../models/Product.php';
include_once '../../models/Cart.php';

// Instantialise DB & connect
$conn = new Database();
$db = $conn->connect();

// Instantiate objs
$product_obj = new Product($db);
$cart_obj = new Cart($db);

// Get raw posted data
$data =json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$product_id = $data['product_id'];
// Generate a Datetime in the wanted format
$datetime = $data['datetime'];
$result = null;
$result2 = null;
if($product_obj->getAvailable($product_id)>0){
  $result = $cart_obj->addCart($user_id, $product_id, $datetime);
  $result2 = $product_obj->decrementAvailable($product_id);
}
// Create user
if ($result==null || $result2==null) {
  echo json_encode(
    array('message' => 'No more products available')
  );
}
else
  echo json_encode(
  array('id' => $result)
);  
?>