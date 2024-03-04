<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-With:');

include_once '../../config/Database.php';
include_once '../../models/Product.php';

// Instantiate DB & connect
$conn = new Database();
$db = $conn->connect();

// Instantiate objs
$product_obj = new Product($db);

// Get raw posted data
$data=json_decode(file_get_contents('php://input'), true);
$result = $product_obj->updateProduct($data['id'],$data['name'],
    $data['product_code'],$data['price'], $data['category'],
    $data['date_of_withdrawal'], $data['available']);

// Update Product
if ($result) {
    echo json_encode(array('message' => 'Product Updated Successfully'));
} else {
    echo json_encode(array('message' => 'No Fields Updated'));
}