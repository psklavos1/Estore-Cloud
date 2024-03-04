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


// Query
$cursor = $product_obj->getProductsAll();
if($cursor == null || $cursor == false){
  $msg = ['message' => "No Products Found"];
  echo json_encode($msg);
  die();
}

// print_r($cursor) ;
// die();
// Get row count
$noRows = 0;
$noRows = count($cursor);
// Check if any posts
if($noRows > 0) {
  // Product array
  $product_obj = array();
  $product_arr['data'] = array();
  foreach($cursor as $doc) {
    $product_item = array(
      'price' => $doc['price'],
      'productcode' => $doc['productcode'],
      'dateofwithdrawal' => $doc['dateofwithdrawal'],
      'id' => (string)$doc['_id'],
      'category' => $doc['category'],
      'name' => $doc['name'],
      'sellername' => $doc['sellername'],
      'incart' => $cart_obj->checkInCart($user_id,$doc['_id'])
    );
    // Push to "data"
    array_push($product_arr["data"], $product_item);
  }

  // Turn to JSON 
  echo json_encode($product_arr);
} else {
  // No users
  echo json_encode(
    array('message' => 'No Products Found')
  );
}
?>