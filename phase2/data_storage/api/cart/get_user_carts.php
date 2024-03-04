<?php
// Headers
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
include_once '../../config/Database.php';
include_once '../../models/Product.php';
include_once '../../models/Cart.php';

// Instantiate db
$conn = new Database();
$db = $conn->connect();
// echo $db;

// Instantiate objs
$product_obj = new Product($db);
$cart_obj = new Cart($db);
$user_id = $_GET['userid'];

// Query to find products in cart
$cursor = $cart_obj->getProductsInCarts($user_id);
if($cursor == null || $cursor == false){
  $msg = ['message' => "No Carts Found"];
  echo json_encode($msg);
  die();
}

// Query to find products thost products Info 
$cursor = $product_obj->getProductsInfo($cursor);
if($cursor == null || $cursor == false){
  $msg = ['message' => "Problem Acquiring Products Info"];
  echo json_encode($msg);
  die();
}

// Get row count
$noRows = 0;
$noRows = count($cursor);
// Check if any carts
if($noRows > 0) {
  // Product array
  $cart_item = array();
  $cart_arr['data'] = array();
  foreach($cursor as $doc) {
    $cart_item = array(
      'id' => (string)$doc['_id'],
      'name' => $doc['name'],
      'latest' => $cart_obj->lastInsertion($user_id,(string)$doc['_id']),
      'price' => $doc['price'],
      'quantity' => $cart_obj->productCartApperances($user_id,(string)$doc['_id']),
    );
    // Push to "data"
    array_push($cart_arr["data"], $cart_item);
  }
  // Turn to JSON 
  echo json_encode($cart_arr);
} else {
  // No users
  echo json_encode(
    array('message' => 'No Products in Cart')
  );
}
?>