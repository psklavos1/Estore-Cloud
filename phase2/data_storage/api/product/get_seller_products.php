<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
include_once '../../config/Database.php';
include_once '../../models/Product.php';

// Instantiate db
$conn = new Database();
$db = $conn->connect();
// echo $db;

// Instantiate objs
$product_obj = new Product($db);
$username = $_GET['username'];

// Query to find seller products
$cursor = $product_obj->getSellerProducts($username);
if($cursor == null || $cursor == false){
  $msg = ['message' => "No Products Found"];
  echo json_encode($msg);
  die();
}

// Get row count
$noRows = 0;
$noRows = count($cursor);
// Check if any products
if($noRows > 0) {
  // Product array
  $product_item = array();
  $product_arr['data'] = array();
  foreach($cursor as $doc) {
    $product_item = array(
      'id' => (string)$doc['_id'],
      'name' => $doc['name'],
      'productcode' => $doc['productcode'],
      'price' => $doc['price'],
      'category' => $doc['category'],
      'dateofwithdrawal' => $doc['dateofwithdrawal'],
      'available' => $doc['available'],
    );
    // Push to "data"
    array_push($product_arr["data"], $product_item);
  }
  // Turn to JSON 
  echo json_encode($product_arr);
} else {
  // No users
  echo json_encode(
    array('message' => 'No Products in Cart')
  );
}
?>