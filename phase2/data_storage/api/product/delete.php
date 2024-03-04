<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-type,Access-Control-Allow-Methods, Authorization, X-Requested-With:');

include_once '../../config/Database.php';
include_once '../../models/Product.php';

// Instantialise DB & connect
$conn = new Database();
$db = $conn->connect();

// Instantiate objs
$product_obj = new Product($db);
// Get data
$data =json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];

// Delete product
if ($product_obj->deleteProduct($product_id)) {
    echo json_encode(
    array('message' => 'SUCCESS')
    );
} else {
echo json_encode(
    array('message' => 'ERROR')
);
}
