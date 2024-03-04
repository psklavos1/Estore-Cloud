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

// Instantiate product obj
$product_obj = new Product($db);
$cart_obj = new Cart($db);
$user_id = $_GET['userid'];

$searchBy = $_GET['searchBy'];
$searchText = $_GET['searchText'];

// Query
$cursor = $product_obj->searchProducts($searchBy,$searchText);
if($cursor == null || $cursor == false){
  $cursor = [];
}

// Get row count
$noRows = 0;
$noRows = count($cursor);

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