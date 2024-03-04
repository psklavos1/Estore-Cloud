<?php
session_start();

$token = $_SESSION["token"];
$proxy = "data-storage-proxy";
$port = "3020";

$userid = $_SESSION['id'];
if(!isset($_GET['searchBy']) || isset($_GET['searchBy']) && $_GET['searchBy']== "showall"){
    $curl = curl_init("http://".$proxy.":".$port."/api/product/get_all.php?userid=".$userid."");
}
else{
    $searchBy = $_GET['searchBy'];
    $searchText = $_GET['searchText'];
    $curl = curl_init("http://".$proxy.":".$port."/api/product/get_search.php?userid=".$userid."&searchBy=".$searchBy."&searchText=".$searchText."");
}

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "X-Auth-token: ".$token.""
));
$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response, true);
$res = "";
if ($result && !array_key_exists('message',$result) && count($result) > 0) {
    foreach($result as $key) {
        foreach($key as $row){
            $default_path ='/estore/assets/_images/products/no-img.png' ;
            $image_path = '/estore/assets/_images/products/'.$row['id'].'.jpg' ;
            $res .= 
            '<div class="box">';
            // In this implementation the image of a product has always a name: product_id.jpg
            // If a such file does not exist in the product images folder then show the default
            // "No image" image.
            
            $res .= file_exists($_SERVER['DOCUMENT_ROOT'].$image_path) ? 
                '<img src = "' . $image_path .'" alt="product"></img>' :
                '<img src = "' . $default_path . '" alt="product"></img>' ;
            $res .= 
                '<div class="content">
                    <h4>'. $row['name'] .'</h4>
                    <p>Product Code: <span>' . $row['productcode'] . '</span></p>'.
                    '<p class = "euro">Price: <span>' . $row['price'] . '</span></p>'.
                    '<p>Date Of Withdrawal: <span>' . $row['dateofwithdrawal'] . '</span></p>'.
                    '<p>Category: <span>' . $row['category'] . '</span></p>' . 
                    '<p>Seller: <span>' . $row['sellername'] . '</span></p>';
                    // To do
            $res .= print_in_cart($row['incart'],$row['id']);
                    
            $res .=  
                    '<div class = "buttons">
                        <div class= "btn-div"><button class="subscribe-btn" id = "'. $row['id'] .'">Subscribe | <i class="fa-solid fa-bell"></i></button></div>
                        <div class= "btn-div"><button class="add-cart" id = "'. $row['id'] .'">Add To Cart</button></div>
                    </div>
                </div>
            </div>';
        }
    }
    echo $res;
    // ?echo file_exists("../../../_images/products/63bc8f5eae3ec141778222eb.jpg") ? "true" : "false";
}
else {
    echo '<h1>'.$result['message'].'</h1>';
}

function print_in_cart($in_cart, $product_id){
    $ret = "";
    $ret .=  
        '<div class="cart">' . 
        '<a href="#" id ="a-'.$product_id.'">';
    $ret .= $in_cart ?
        '<i class = "fa-solid fa-cart-shopping" style = "color:purple;"></i></a></div>':
        '<i class = "fa-solid fa-cart-shopping"></i></a></div>';
    return $ret;
}
    
?>