<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-With:');

include_once '../../config/Database.php';
include_once '../../models/Product.php';

// Instantiate DB & connect
$conn = new Database();
$db = $conn->connect();

// Instantiate objs
$product_obj = new Product($db);

// Get raw posted data
$data =json_decode(file_get_contents('php://input'), true);

$result = $product_obj->addProduct($data['name'], $data['product_code'],
$data['price'], $data['category'],$data['date_of_withdrawal'],$data['username'], $data['available']);
// Create user
if ($result == false) {
  echo json_encode(
    array('message' => 'Failed to Add Product')
  );
}
else
  echo json_encode(
  array('id' => $result)
);  
?>