<?php
session_start();
$token = $_SESSION["token"];
$proxy = "data-storage-proxy";
$port = "3020";
$userid = $_SESSION['id'];

$curl = curl_init("http://".$proxy.":".$port."/api/cart/get_user_carts.php?userid=".$userid);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "X-Auth-token: ".$token.""
));

$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response, true);

$res = "";
$carts_sum =0;
if ($result && !array_key_exists('message',$result) && count($result) > 0) {
    foreach($result as $key) {
        foreach($key as $row){
            $quantity = $row['quantity'];
            $last_insertion_date = $row['latest'];
            $product_name = $row['name'];
            $product_id = $row['id'];
            $price = $row['price'];
            $subtotal = $quantity*$price;
            
            $res .=
                '<tr id= "'.$product_id.'">
                    <td>
                        <button class="remove-btn" ><i class="fa-regular fa-trash-can fa-xl"></i></button>
                    </td>
                    <td>
                        <img src="../../../_images/products/'. $product_id .'.jpg" alt="product">
                    </td>
                    <td>'. $product_name .'</td>
                    <td>'. $last_insertion_date .'</td>
                    <td class="euro price">'.$price.'</td>
                    <td class>
                        <div class = "wrapper">
                            <button class="item decrement-btn">-</button>
                            <span class="item number">'.$quantity.'</span>
                            <button class="item increment-btn">+</button>
                        </div>
                    </td>
                    <td class="euro subtotal-td">'.$subtotal.'</td>
                </tr>';
            
                $carts_sum += $subtotal;
        }
    }
    $ret = json_encode(array("html"=> $res, "carts_sum" => $carts_sum));
}
else $ret = json_encode(array('html'=>"<h1 style = \"text-align: center;  font-size: 45px;\">No Items Found In Cart</h1>", "carts_sum" => $carts_sum));
echo $ret;
 
?>